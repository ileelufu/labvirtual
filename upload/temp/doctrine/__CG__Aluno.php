<?php

namespace DoctrineProxies\__CG__;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Aluno extends \Aluno implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', 'id', 'nome', 'email', 'senha', 'dtCadastro', 'recuperaSenhaData', 'recuperaSenhaHash', 'criarContaHash', 'ativo', 'login', 'aceiteTermo'];
        }

        return ['__isInitialized__', 'id', 'nome', 'email', 'senha', 'dtCadastro', 'recuperaSenhaData', 'recuperaSenhaHash', 'criarContaHash', 'ativo', 'login', 'aceiteTermo'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Aluno $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', [$id]);

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getNome()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNome', []);

        return parent::getNome();
    }

    /**
     * {@inheritDoc}
     */
    public function setNome($nome)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNome', [$nome]);

        return parent::setNome($nome);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', []);

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail($email)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', [$email]);

        return parent::setEmail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function getSenha()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSenha', []);

        return parent::getSenha();
    }

    /**
     * {@inheritDoc}
     */
    public function setSenha($senha)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSenha', [$senha]);

        return parent::setSenha($senha);
    }

    /**
     * {@inheritDoc}
     */
    public function getDtCadastro()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDtCadastro', []);

        return parent::getDtCadastro();
    }

    /**
     * {@inheritDoc}
     */
    public function setDtCadastro($dtCadastro)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDtCadastro', [$dtCadastro]);

        return parent::setDtCadastro($dtCadastro);
    }

    /**
     * {@inheritDoc}
     */
    public function getRecuperaSenhaData()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRecuperaSenhaData', []);

        return parent::getRecuperaSenhaData();
    }

    /**
     * {@inheritDoc}
     */
    public function setRecuperaSenhaData($recuperaSenhaData)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRecuperaSenhaData', [$recuperaSenhaData]);

        return parent::setRecuperaSenhaData($recuperaSenhaData);
    }

    /**
     * {@inheritDoc}
     */
    public function getRecuperaSenhaHash()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRecuperaSenhaHash', []);

        return parent::getRecuperaSenhaHash();
    }

    /**
     * {@inheritDoc}
     */
    public function setRecuperaSenhaHash($recuperaSenhaHash)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRecuperaSenhaHash', [$recuperaSenhaHash]);

        return parent::setRecuperaSenhaHash($recuperaSenhaHash);
    }

    /**
     * {@inheritDoc}
     */
    public function getCriarContaHash()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCriarContaHash', []);

        return parent::getCriarContaHash();
    }

    /**
     * {@inheritDoc}
     */
    public function setCriarContaHash($criarContaHash)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCriarContaHash', [$criarContaHash]);

        return parent::setCriarContaHash($criarContaHash);
    }

    /**
     * {@inheritDoc}
     */
    public function getAtivo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAtivo', []);

        return parent::getAtivo();
    }

    /**
     * {@inheritDoc}
     */
    public function setAtivo($ativo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAtivo', [$ativo]);

        return parent::setAtivo($ativo);
    }

    /**
     * {@inheritDoc}
     */
    public function getLogin()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLogin', []);

        return parent::getLogin();
    }

    /**
     * {@inheritDoc}
     */
    public function setLogin($login)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLogin', [$login]);

        return parent::setLogin($login);
    }

    /**
     * {@inheritDoc}
     */
    public function getAceiteTermo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAceiteTermo', []);

        return parent::getAceiteTermo();
    }

    /**
     * {@inheritDoc}
     */
    public function setAceiteTermo($aceiteTermo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAceiteTermo', [$aceiteTermo]);

        return parent::setAceiteTermo($aceiteTermo);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'toArray', []);

        return parent::toArray();
    }

}
