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
class __TwigTemplate_6f226c479f5f65224d409efbdd40bfd41eb5f9acc239ca07ca9ac4a1f4e8254f extends \Twig\Template
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
        echo "        \t\t\t\tlowerCase Filter : ";
        echo twig_escape_filter($this->env, twig_lower_filter($this->env, ($context["username"] ?? null)), "html", null, true);
        echo "<br>
        \t\t\t\tupperCase Filter : ";
        // line 3
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, ($context["lastname"] ?? null)), "html", null, true);
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
        return new Source("{# Filter #}
        \t\t\t\tlowerCase Filter : {{ username|lower }}<br>
        \t\t\t\tupperCase Filter : {{ lastname|upper }}", "template", "");
    }
}
