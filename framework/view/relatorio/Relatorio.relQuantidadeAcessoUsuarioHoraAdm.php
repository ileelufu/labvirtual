<?
if ($response->get("total") == 0) {
    include IGENIAL_DIR_BIBVIEW . '/empty.php';
} else {

    $aHora = $response->get('aHora');
    $aAluno = $response->get('aAluno');

    $objects = $response->get("objects");
    $orderPageConditions = $response->get("orderPageConditions");
    $orderPageLinks = $response->get("orderPageLinks");
    $currentPageLink = "&page={$response->get("currentPage")}";
    $orderAscDesc = "&orderAscDesc={$response->get("orderAscDesc")}";
    $allFilters = "{$orderPageConditions}{$currentPageLink}{$orderAscDesc}{$response->get("porPagina")}";
    $delHandlerCurrPage = Util::getAdmPageDelHandlerCurrPage($response->get("resultsInPage"), $response->get("currentPage"));

    $orderAscDescRel = "&orderAscDesc=" . ControllerUtil::orderInverteAscDesc($orderAscDesc);
    $allFiltersRel = "order={$response->get("order")}{$orderPageConditions}{$currentPageLink}{$orderAscDescRel}&porPagina={$response->get('resultsInPage')}";
    ?>


    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget jarviswidget-color-darken" id="wid-id-1" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                <h2>Quantidade Acesso por Usuário por Hora</h2>
                <div class="widget-toolbar" role="menu"> 
                    <?php echo $response->get("perPageLinks") ?>
                </div>
                <div class="widget-toolbar" role="menu"> 
                    <?php echo $response->get("paginationLinks") ?>
                </div>
                <div class="widget-toolbar" role="menu">
                    <a class="btn btn-info btn-xs" rel="tooltip" data-placement="top" title="Baixar PDF" target="_BLANK" href="<?php echo URL_APP ?><?= $this->module ?>/Relatorio/relQuantidadeAcessoUsuarioHoraRelPdf?<?php echo $allFiltersRel ?>">
                        <span class="fa fa fa-file-pdf-o"></span>
                    </a>
                </div>
            </header>
            <div>
                <!-- widget content -->
                <div class="widget-body no-padding">
                    <form id="resultados" method="post" autocomplete="off" enctype='multipart/form-data' class='overflow_table'>
                        <table class="table table-bordered table-striped with-check table-hover">
                            <thead>
                                <tr>
                                    <th>Usuário</th>
                                    <?php
                                    foreach ($aHora as $h) {
                                        ?>
                                        <th><?php echo $h ?>H</th>
                                    <? } ?>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                foreach ($aAluno as $k => $a) {
                                    $totalAcesso = array_sum($a);
                                    ?>
                                    <tr>
                                        <td><?= $k ?></td>
                                        <?php
                                        foreach ($aHora as $h) {
                                            if (isset($a[$h])) {
                                                echo "<td>{$a[$h]}</td>";
                                            } else {
                                                echo "<td>-</td>";
                                            }
                                        }
                                        ?>
                                        <td><?= $totalAcesso ?></td>
                                    </tr>
                                <? } ?>
                            </tbody>
                        </table>							
                        <input type="hidden" id="__gen_currpage_del_handler__" value="<?php echo $delHandlerCurrPage ?>" />
                        <input type="hidden" id="__gen_order_del_handler__" value="<?php echo "{$orderPageLinks}{$orderPageConditions}" ?>" />
                        <div class="widget-footer">
                            <a href="#content" onclick="scrollAnimado(this)"><i class="fa fa-arrow-up"></i> Ir para o topo</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </article>
    <?
}?>