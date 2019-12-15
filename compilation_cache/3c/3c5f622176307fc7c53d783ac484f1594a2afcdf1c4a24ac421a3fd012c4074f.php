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
class __TwigTemplate_b996544bf5d78f45fbfd2fe4cec1b74e39d637ffd5218d2ac5974f028473b79c extends \Twig\Template
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
        echo "        \t\t\t";
        if ((($context["age"] ?? null) < 25)) {
            // line 3
            echo "        \t\t\t\t";
            echo twig_escape_filter($this->env, ($context["username"] ?? null), "html", null, true);
            echo " is still too young.
        \t\t\t";
        } elseif ((        // line 4
($context["age"] ?? null) > 25)) {
            // line 5
            echo "        \t\t\t\t";
            echo twig_escape_filter($this->env, ($context["username"] ?? null), "html", null, true);
            echo " is getting old now.
        \t\t\t";
        } else {
            // line 7
            echo "        \t\t\t\t";
            echo twig_escape_filter($this->env, ($context["username"] ?? null), "html", null, true);
            echo " is 25 years old.
        \t\t\t";
        }
        // line 9
        echo "        \t\t\t";
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
        return array (  59 => 9,  53 => 7,  47 => 5,  45 => 4,  40 => 3,  37 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("{# if elseif else Condition #}
        \t\t\t{% if age < 25 %}
        \t\t\t\t{{ username }} is still too young.
        \t\t\t{% elseif age > 25 %}
        \t\t\t\t{{ username }} is getting old now.
        \t\t\t{% else %}
        \t\t\t\t{{ username }} is 25 years old.
        \t\t\t{% endif %}
        \t\t\t", "template", "");
    }
}
