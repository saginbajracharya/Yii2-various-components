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
class __TwigTemplate_0d2c8de52f0adc9b9d907bf47a19d9f1b440f2cb91d8200573f0a7ba860595ba extends \Twig\Template
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
        echo "        \t\t\t<h4>Active Members</h4>
\t\t\t\t\t";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["params"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            if (twig_get_attribute($this->env, $this->source, $context["user"], "active", [], "any", false, false, false, 3)) {
                // line 4
                echo "\t\t\t\t\t\t<li>";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["user"], "username", [], "any", false, false, false, 4));
                echo "</li>
\t\t\t\t\t";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
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
        return array (  45 => 4,  40 => 3,  37 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("{# for loop with if condition #}
        \t\t\t<h4>Active Members</h4>
\t\t\t\t\t{% for user in params if user.active %}
\t\t\t\t\t\t<li>{{ user.username|e }}</li>
\t\t\t\t\t{% endfor %}", "template", "");
    }
}
