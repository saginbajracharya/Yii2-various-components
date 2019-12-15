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
class __TwigTemplate_ce3d28a8ef5a5f2fd1a0d535d805af5d6286f9b662f4d1465dc0514807d9eeef extends \Twig\Template
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
        echo "\t\t\t\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_array_keys_filter(($context["params"] ?? null)));
        foreach ($context['_seq'] as $context["_key"] => $context["key"]) {
            // line 3
            echo "\t\t\t\t\t\t<li>";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "</li>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['key'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
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
        return new Source("{# for loop Iterating over Keys #}
\t\t\t\t\t{% for key in params|keys %}
\t\t\t\t\t\t<li>{{ key }}</li>
\t\t\t\t\t{% endfor %}", "template", "");
    }
}
