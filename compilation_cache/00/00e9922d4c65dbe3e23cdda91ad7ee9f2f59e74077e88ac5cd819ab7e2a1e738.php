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
class __TwigTemplate_cc47a4a6c83708c0351c99c75231fdf58833f26727818b43a98889137a3a8eee extends \Twig\Template
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
        echo "    \t\t\t\t<span><b>Hello</b></span> ";
        echo twig_escape_filter($this->env, ($context["username"] ?? null), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, ($context["lastname"] ?? null), "html", null, true);
        echo " hello231";
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
        return array (  37 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("{# Accessing variable by {{ }} #}
    \t\t\t\t<span><b>Hello</b></span> {{ username }} {{ lastname }} hello231", "template", "");
    }
}
