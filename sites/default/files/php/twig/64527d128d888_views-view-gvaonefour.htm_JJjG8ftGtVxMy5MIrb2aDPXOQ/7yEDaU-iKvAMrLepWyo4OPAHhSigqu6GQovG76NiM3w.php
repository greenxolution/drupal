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

/* modules/gavias_view/templates/views-view-gvaonefour.html.twig */
class __TwigTemplate_b326d2fd05e56554d18d7c0d57a11afd extends Template
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
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        if (($context["attributes"] ?? null)) {
            // line 2
            echo "<div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null), 2, $this->source), "html", null, true);
            echo ">
";
        }
        // line 4
        echo "   
  ";
        // line 5
        if (($context["title"] ?? null)) {
            // line 6
            echo "    <h3>";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 6, $this->source), "html", null, true);
            echo "</h3>
  ";
        }
        // line 8
        echo "
  ";
        // line 9
        $context["i"] = 0;
        // line 10
        echo "    ";
        $context["j"] = 0;
        // line 11
        echo "  ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["rows"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 12
            echo "    ";
            $context["i"] = (($context["i"] ?? null) + 1);
            // line 13
            echo "    ";
            $context["j"] = (($context["j"] ?? null) + 1);
            // line 14
            echo "    ";
            if ((($context["i"] ?? null) == 1)) {
                echo "<div class=\"big-row row\">";
            }
            // line 15
            echo "      ";
            if ((($context["i"] ?? null) == 1)) {
                // line 16
                echo "        <div class=\"item index-";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["i"] ?? null), 16, $this->source), "html", null, true);
                echo " first-item col-md-6 col-sm-12 col-xs-12\">
          <div";
                // line 17
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["row"], "attributes", [], "any", false, false, true, 17), 17, $this->source), "html", null, true);
                echo ">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["row"], "content", [], "any", false, false, true, 17), 17, $this->source));
                echo "</div>
        </div>
      ";
            } else {
                // line 20
                echo "        ";
                if ((($context["i"] ?? null) == 2)) {
                    echo " <div class=\"small-items col-md-6 col-sm-12 col-xs-12\">";
                }
                // line 21
                echo "          ";
                if (((($context["i"] ?? null) % 2) == 0)) {
                    echo "<div class=\"row\">";
                }
                // line 22
                echo "            <div class=\"item index-";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["i"] ?? null), 22, $this->source), "html", null, true);
                echo " col-sm-6 col-xs-12\">
              <div";
                // line 23
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["row"], "attributes", [], "any", false, false, true, 23), 23, $this->source), "html", null, true);
                echo ">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["row"], "content", [], "any", false, false, true, 23), 23, $this->source));
                echo "</div>
            </div>
          ";
                // line 25
                if ((((($context["i"] ?? null) % 2) == 1) || (($context["j"] ?? null) == twig_length_filter($this->env, ($context["rows"] ?? null))))) {
                    echo " </div> ";
                }
                // line 26
                echo "        ";
                if (((($context["i"] ?? null) == 5) || (($context["j"] ?? null) == twig_length_filter($this->env, ($context["rows"] ?? null))))) {
                    echo " </div>";
                }
                echo "    
      ";
            }
            // line 28
            echo "    ";
            if (((($context["i"] ?? null) == 5) || (($context["j"] ?? null) == twig_length_filter($this->env, ($context["rows"] ?? null))))) {
                echo "</div>";
            }
            // line 29
            echo "    ";
            if ((($context["i"] ?? null) == 5)) {
                $context["i"] = 0;
            }
            // line 30
            echo "  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        echo "
";
        // line 32
        if (($context["attributes"] ?? null)) {
            // line 33
            echo "</div>
";
        }
    }

    public function getTemplateName()
    {
        return "modules/gavias_view/templates/views-view-gvaonefour.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  153 => 33,  151 => 32,  148 => 31,  142 => 30,  137 => 29,  132 => 28,  124 => 26,  120 => 25,  113 => 23,  108 => 22,  103 => 21,  98 => 20,  90 => 17,  85 => 16,  82 => 15,  77 => 14,  74 => 13,  71 => 12,  66 => 11,  63 => 10,  61 => 9,  58 => 8,  52 => 6,  50 => 5,  47 => 4,  41 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/gavias_view/templates/views-view-gvaonefour.html.twig", "/var/www/html/calpemar.com/modules/gavias_view/templates/views-view-gvaonefour.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 1, "set" => 9, "for" => 11);
        static $filters = array("escape" => 2, "raw" => 17, "length" => 25);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set', 'for'],
                ['escape', 'raw', 'length'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
