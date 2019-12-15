<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* template */
class __TwigTemplate_15474e21214a9177e8fed1292606b2bab65f2fc89c3b6414b49cb9536fa74833 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 2
        echo "        \t\t\tparams length : ";
        echo twig_escape_filter($this->env, twig_length_filter($this->env, ($context["params"] ?? null)), "html", null, true);
        echo "
        \t\t\t";
        // line 3
        echo twig_var_dump($this->env, $context, ...[0 => ($context["params"] ?? null)]);
    }

    public function getTemplateName()
    {
        return "template";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 3,  37 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("{# dump requires twig extension #}
        \t\t\tparams length : {{params|length}}
        \t\t\t{{ dump(params) }}", "template", "");
    }
}
