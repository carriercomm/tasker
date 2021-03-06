<?php

/* /source/html/jpaginator.html */
class __TwigTemplate_53765eddde8968e55a00e29b38b465ed extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if ($this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "total")) {
            // line 2
            echo \layout::func_from_text("    <span class=\"\">");
            echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "from"), "html", null, true));
            echo \layout::func_from_text(" - ");
            echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "to"), "html", null, true));
            echo \layout::func_from_text(" <b>из ");
            echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "total"), "html", null, true));
            echo \layout::func_from_text("</b></span>
");
        }
        // line 4
        echo \layout::func_from_text("<span class=\"paginator\">
");
        // line 5
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "num_list"));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 6
            if (($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "first") && ((isset($context["i"]) ? $context["i"] : null) != 1))) {
                echo \layout::func_from_text("<a href=\"#\" onclick=\"get_page(1);return false;\">1</a>");
                if (((isset($context["i"]) ? $context["i"] : null) > 2)) {
                    echo \layout::func_from_text("<span>&nbsp;...</span>");
                }
            }
            // line 7
            if (((isset($context["i"]) ? $context["i"] : null) == $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "current_page"))) {
                // line 8
                echo \layout::func_from_text("    <span><b>");
                echo \layout::func_from_text(twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : null), "html", null, true));
                echo \layout::func_from_text("</b></span>
");
            } else {
                // line 10
                echo \layout::func_from_text("    <a href=\"#\" onclick=\"get_page('");
                echo \layout::func_from_text(twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : null), "html", null, true));
                echo \layout::func_from_text("');return false;\">");
                echo \layout::func_from_text(twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : null), "html", null, true));
                echo \layout::func_from_text("</a>
");
            }
            // line 12
            if (($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "last") && ((isset($context["i"]) ? $context["i"] : null) != $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "get_pages")))) {
                if (((isset($context["i"]) ? $context["i"] : null) < ($this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "get_pages") - 1))) {
                    echo \layout::func_from_text("<span>...&nbsp;</span>");
                }
                echo \layout::func_from_text("<a href=\"#\" onclick=\"get_page('");
                echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "get_pages"), "html", null, true));
                echo \layout::func_from_text("');return false;\">");
                echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "get_pages"), "html", null, true));
                echo \layout::func_from_text("</a> ");
            }
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 14
        echo \layout::func_from_text("&#160;</span>
");
    }

    public function getTemplateName()
    {
        return "/source/html/jpaginator.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 12,  66 => 10,  60 => 8,  51 => 6,  21 => 2,  78 => 19,  71 => 17,  58 => 7,  55 => 15,  37 => 14,  22 => 2,  19 => 1,  149 => 39,  146 => 38,  142 => 36,  138 => 34,  132 => 33,  128 => 31,  113 => 29,  109 => 28,  104 => 27,  102 => 26,  97 => 14,  93 => 24,  86 => 19,  77 => 17,  73 => 16,  70 => 15,  68 => 14,  65 => 13,  59 => 11,  56 => 10,  53 => 9,  47 => 7,  42 => 6,  39 => 5,  34 => 5,  31 => 4,);
    }
}
