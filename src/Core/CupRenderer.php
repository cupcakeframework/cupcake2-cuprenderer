<?php

namespace CupCake2\Core;

use Exception;

class CupRenderer {

    /**
     * Array with all templates folder
     * @var Array 
     */
    public $templatesFolder;

    /**
     * Array with all views folder
     * @var Array 
     */
    public $viewsFolder;

    /**
     * The template file to be rendered
     * @var String 
     */
    public $templateFile;

    /**
     * Global Variables that will be inserted before rendering
     * @var Array 
     */
    public $globals;

    public function getGlobals() {
        return $this->globals;
    }

    public function insertGlobal($key, $var) {
        $this->globals[$key] = $var;
    }

    function __construct(Array $templatesFolder, Array $viewsFolder) {
        $this->templatesFolder = $templatesFolder;
        $this->viewsFolder = $viewsFolder;
    }

    public function getTemplateFile() {
        return $this->templateFile;
    }

    public function setTemplateFile($templateFile) {
        $this->templateFile = $templateFile;
    }

    private function resolveTemplate($templateFile) {
        foreach ($this->templatesFolder as $templateFolder) {
            if (file_exists($templateFolder . $templateFile) && !is_dir($templateFolder . $templateFile)) {
                return $templateFolder . $templateFile;
            }
        }
        throw new Exception("O template $templateFile não foi encontrado em nenhum diretório do mapa de diretórios");
    }

    private function resolveView($viewFile) {
        foreach ($this->viewsFolder as $viewFolder) {
            if (file_exists($viewFolder . $viewFile) && !is_dir($viewFolder . $viewFile)) {
                return $viewFolder . $viewFile;
            }
        }
        throw new Exception("A View $viewFile não foi encontrada em nenhum diretório do mapa de diretórios");
    }

    public function render($viewFile, array $variaveis = array(), $retornar = false) {
        $view = $this->resolveView($viewFile);
        $template = $this->resolveTemplate($this->templateFile);
        $content = $this->_render($view, $variaveis, true);
        $variaveis['content'] = $content;
        return $this->_render($template, $variaveis, $retornar);
    }

    public function renderPartial($nomeView, array $variaveis = array(), $retornar = false) {
        $view = $this->resolveView($nomeView);
        return $this->_render($view, $variaveis, $retornar);
    }

    protected function _render($arquivoParaRenderizar, array $variaveis = array(), $retornar = false) {
        ob_start();
        extract($variaveis);
        extract($this->globals);
        include($arquivoParaRenderizar);
        $retorno = ob_get_contents();
        ob_end_clean();
        if ($retornar) {
            return $retorno;
        } else {
            print $retorno;
        }
    }

}
