<?php
class TemaControllerParent {

    protected $request;
    protected $response;
    protected $view;
    protected $viewMethod = 'module';
	protected $gapPerPage = 10;
    
    protected function auth($isOnlyAuthenticated = false){
        $oUtilAuth = new UtilAuth();
        if (!$oUtilAuth->usuarioAutenticado($this->request->get("action"), $isOnlyAuthenticated)){
            $this->view = $oUtilAuth->retornaViewLogin($this->response);
            return false;
        }
        return true;
    }

    public function form(){
        if($this->auth() === FALSE)
            return $this->view;
        return new View(TemaAction::getModuleName().'/Tema.form.php',$this->response, $this->viewMethod);
    }

    public function formSubmit(){
        if($this->auth() === FALSE)
            return $this->view;
        try {
            $oTemaAction = new TemaAction();
            $oTemaAction->validate($this->request);
            $oTema = $oTemaAction->add($this->request, true, true);
        } catch (Exception $ex) {
            return new View(ExceptionHandler::getMessage($ex),$this->response,'print');
        }
        return new View('OK',$this->response,'print');
    }

    public function admFilter() {
        if($this->auth() === FALSE)
            return $this->view;
        $this->adm();
        return new View(TemaAction::getModuleName().'/Tema.admFilter.php',$this->response, $this->viewMethod);
    }

    public function adm() {
        if($this->auth() === FALSE)
            return $this->view;
        
        $orderSql = ControllerUtil::orderFunction($this->request, $this->response, 'id DESC', $orderPageLinks);
        
        $orderPageConditions = '';
        
        $oTemaAction = new TemaAction();
        
        $conditions = $oTemaAction->filterConditions($this->request, $this->response, $orderPageConditions);
        
        # paginacao
        $fields = $oTemaAction->getAdmFields();
        $page = (int) $this->request->get("page") ? (int) $this->request->get("page") : 0;
		$this->gapPerPage = (int) $this->request->get("porPagina") ? (int) $this->request->get("porPagina") : $this->gapPerPage;
        
        $resultsPerPage = ControllerUtil::porPagina($this->request, $this->response, "Tema");
        
        $conditions = join(" AND ", $conditions);
        $objects = $oTemaAction->paginatedCollection($fields, ($page * $resultsPerPage), $resultsPerPage, $conditions, $orderSql, FALSE, $paginator);
        $total = $paginator->count();
        $this->response->set("orderPageConditions", $orderPageConditions);
        $this->response->set("orderPageLinks", $orderPageLinks);
        $this->response->set("objects", $objects);
        $this->response->set("total", $total);
        $this->response->set("resultsInPage", $resultsPerPage);
        $this->response->set("paginationLinks", Paging::getPageLinks(TemaAction::getModuleName(), "Tema","admFilter", $total, $this->gapPerPage, $page, "{$orderPageConditions}{$orderPageLinks}", $this->request->get("porPagina")));
        $this->response->set("perPageLinks", Paging::quantidadePorPagina(TemaAction::getModuleName(), "Tema","admFilter", $page, "{$orderPageConditions}{$orderPageLinks}", $this->request->get("porPagina")));
        $this->response->set("currentPage", $page);
        return new View(TemaAction::getModuleName().'/Tema.adm.php',$this->response, $this->viewMethod);
    }

    public function view() {
        if($this->auth(true) === FALSE)
            return $this->view;
        $oTemaAction = new TemaAction();
        $id = (int) $this->request->get("id");
        $o = $oTemaAction->select($id);
        if ($o === null){
            if($this->viewMethod == "include"){
                return new View('Nenhum registro encontrado!',$this->response,'print');
            }else{
                return $this->admFilter();
            }
        }
        $this->response->set("object",$o);
        return new View(TemaAction::getModuleName().'/Tema.view.php',$this->response, $this->viewMethod);
    }
    
    public function edit() {
        if($this->auth() === FALSE)
            return $this->view;
        $oTemaAction = new TemaAction();
        $id = (int) $this->request->get("id");
        $o = $oTemaAction->select($id);
        if ($o === null) return $this->admFilter();
        $this->response->set("object",$o);
        return new View(TemaAction::getModuleName().'/Tema.edit.php',$this->response, $this->viewMethod);
    }

    public function editSubmit(){
        if($this->auth() === FALSE)
            return $this->view;
        try {
            $oTemaAction = new TemaAction();
            $oTemaAction->validate($this->request,true);
            $oTema = $oTemaAction->edit($this->request);
        } catch (Exception $ex) {
            return new View(ExceptionHandler::getMessage($ex),$this->response,'print');
        }
        return new View('OK',$this->response,'print');
    }    

    public function del() {
        if($this->auth() === FALSE)
            return $this->view;
        try {
            $id = (int) $this->request->get("id");
            $oTemaAction = new TemaAction();
            $oTemaAction->validateDel($id);
            $oTemaAction->delLogical($id);
        } catch (Exception $ex) {
            return new View(ExceptionHandler::getMessage($ex),$this->response,'print');
        }
        return new View('OK',$this->response,'print');
    }
    
    public function delSelected() {
        if($this->auth() === FALSE)
            return $this->view;
        try {
            $oTemaAction = new TemaAction();
            $ids = $this->request->get("seleciona");
            if (!$ids){
                throw new Exception(NO_SELECTED_MSG);
            }
            $oTemaAction->validateDel($ids, false);
            $oTemaAction->delLogicalSelected($ids);
        } catch (Exception $ex) {
            return new View(ExceptionHandler::getMessage($ex),$this->response,'print');
        }
        return new View('OK',$this->response,'print');
    }
    
    public function relPDF(){
        $oUtilAuth = new UtilAuth();
        if (!$oUtilAuth->usuarioAutenticado($this->request->get("action")))
            return $oUtilAuth->retornaViewLogin($this->response);
			
		if($this->request->get("porPagina") === "T"){
			$method_view = "include";
			$this->response->set("porPagina", $this->request->get("porPagina"));
		}else{
			$method_view = "relPdf";
			$this->response->set("orientacao", $this->request->get('orientation') ? $this->request->get('orientation') : "portrait");
		}
        $this->adm();
        return new View(TemaAction::getModuleName().'/Tema.relPdf.php',$this->response, $method_view);
    }
    
    public function relXLS(){
        $oUtilAuth = new UtilAuth();
        if (!$oUtilAuth->usuarioAutenticado($this->request->get("action")))
            return $oUtilAuth->retornaViewLogin($this->response);
        
		$this->adm();
		$objects = $this->response->get("objects");
				
        $aFieldsStructure = TemaAction::getFieldsStructure();
		$aFieldsTypeGenial = TemaAction::getFieldsTypeGenial();
        $aTableHeader = array();
        foreach ($aFieldsStructure as $k => $aField) {
			$typeGenial = is_array($aFieldsTypeGenial[$aField['fieldName']])?$aFieldsTypeGenial[$aField['fieldName']][0]:$aFieldsTypeGenial[$aField['fieldName']];
			if (!in_array($typeGenial, array("autoinc","file","log_usuario", "log_del", "log_data"))) {
				switch($typeGenial){
					case "suggest": case "obj":
						$aTableHeader[$k] = array("type" => "fk", "title" => $aField["columnDefinition"], "value" => $aFieldsTypeGenial[$aField['fieldName']][1]);
					break;
					case "sim/nao":
						$field_name = ucfirst($aField['fieldName']);
						eval("\$aRetSimNao = ConItemSiteAction::getValuesFor{$field_name}();");						
						$aTableHeader[$k] = array("type" => "sim/nao", "title" => $aField["columnDefinition"], "value" => $aRetSimNao);
					break;
					case "date":
						$aTableHeader[$k] = array("type" => "date", "title" => $aField["columnDefinition"], "value" => "date");
					break;
					default:
						$aTableHeader[$k] = array("type" => null, "title" => $aField["columnDefinition"], "value" => "");
					break;
				}
			}
        }
        Util::relXls($objects, $aTableHeader, "Tema", "TemaAction");

        return new View(null, $this->response, 'specificHeader');
    }

    public function suggest($conditions = array(), $order = 'titulo') {
        $oUtilAuth = new UtilAuth();
        if (!$oUtilAuth->usuarioAutenticado($this->request->get("action"), true))
            return $oUtilAuth->retornaViewLogin($this->response);
        
        $descValue = preg_replace(array('/\(/', '/\)/'), array('\(', '\)'),  $this->request->get('descValue') );
        $idValue = $this->request->get('idValue');
		$limit = $this->request->get('all') ? NULL : POR_PAGINA;

        $page = (int) $this->request->get("pageSuggest") ? (int) $this->request->get("pageSuggest") : 0;
        
        $oTemaAction = new TemaAction();
        if ($idValue) {
            $objects = ($o = $oTemaAction->select($idValue))? array($o) :false;
        } else {
            if ($descValue) {
                if(count($conditions) <= 0)
                    $conditions[] = "o.titulo LIKE '%{$descValue}%' ";
            }
            $objects = $oTemaAction->paginatedCollection(null, ($page * $limit), $limit, $conditions, $order);
        }        
        return new View( ControllerUtil::objectsToSuggest($oTemaAction,$objects, $page, 'getId'), $this->response, 'print');
    }


    
}
?>