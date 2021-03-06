<?php

/* /source/admin/jpaginator_boot.html */
class __TwigTemplate_9453bebaa6de6b2df414e46c0a8f719a extends Twig_Template
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
        if ($this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "num_list")) {
            // line 2
            echo \layout::func_from_text("<table style=\"width: 100%\"
    <tr>
        ");
            // line 4
            if ($this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "total")) {
                // line 5
                echo \layout::func_from_text("            <td>");
                echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "from"), "html", null, true));
                echo \layout::func_from_text(" - ");
                echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "to"), "html", null, true));
                echo \layout::func_from_text(" <b>из ");
                echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "total"), "html", null, true));
                echo \layout::func_from_text("</b></td>
        ");
            }
            // line 7
            echo \layout::func_from_text("        <td style=\"white-space: nowrap;text-align: right;\">
            <ul class=\"pagination\" style=\"margin: 0px;\">
                ");
            // line 9
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
                // line 10
                echo \layout::func_from_text("                    ");
                if (($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "first") && ((isset($context["i"]) ? $context["i"] : null) != 1))) {
                    // line 11
                    echo \layout::func_from_text("                        <li><a href=\"#\" onclick=\"get_page(1);return false;\">1</a></li>
                        ");
                    // line 12
                    if (((isset($context["i"]) ? $context["i"] : null) > 2)) {
                        echo \layout::func_from_text("<li><a href=\"\" onclick=\"return false;\">...</a></li></li>");
                    }
                    // line 13
                    echo \layout::func_from_text("                    ");
                }
                // line 14
                echo \layout::func_from_text("
                    ");
                // line 15
                if (((isset($context["i"]) ? $context["i"] : null) == $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "current_page"))) {
                    // line 16
                    echo \layout::func_from_text("                        <li class=\"active\"><a href=\"\" onclick=\"return false;\">");
                    echo \layout::func_from_text(twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : null), "html", null, true));
                    echo \layout::func_from_text("</a></li>
                    ");
                } else {
                    // line 18
                    echo \layout::func_from_text("                        <li><a href=\"#\" onclick=\"get_page('");
                    echo \layout::func_from_text(twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : null), "html", null, true));
                    echo \layout::func_from_text("');return false;\">");
                    echo \layout::func_from_text(twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : null), "html", null, true));
                    echo \layout::func_from_text("</a></li>
                    ");
                }
                // line 20
                echo \layout::func_from_text("
                    ");
                // line 21
                if (($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "last") && ((isset($context["i"]) ? $context["i"] : null) != $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "get_pages")))) {
                    // line 22
                    echo \layout::func_from_text("                        ");
                    if (((isset($context["i"]) ? $context["i"] : null) < ($this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "get_pages") - 1))) {
                        echo \layout::func_from_text("<li><a href=\"\" onclick=\"return false;\">...</a></li>");
                    }
                    // line 23
                    echo \layout::func_from_text("                        <li><a href=\"#\" onclick=\"get_page('");
                    echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "get_pages"), "html", null, true));
                    echo \layout::func_from_text("');return false;\">");
                    echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["paginator"]) ? $context["paginator"] : null), "get_pages"), "html", null, true));
                    echo \layout::func_from_text("</a></li>
                    ");
                }
                // line 25
                echo \layout::func_from_text("                ");
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
            // line 26
            echo \layout::func_from_text("            </ul>
        </td>
    </tr>
</table>
");
        }
    }

    public function getTemplateName()
    {
        return "/source/admin/jpaginator_boot.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  108 => 25,  100 => 23,  95 => 22,  93 => 21,  90 => 20,  76 => 16,  64 => 12,  61 => 11,  58 => 10,  41 => 9,  37 => 7,  27 => 5,  25 => 4,  75 => 18,  68 => 13,  55 => 15,  52 => 14,  34 => 13,  19 => 1,  537 => 366,  532 => 301,  522 => 367,  520 => 366,  454 => 302,  452 => 301,  444 => 295,  425 => 292,  418 => 291,  414 => 290,  247 => 125,  241 => 124,  234 => 120,  226 => 119,  222 => 118,  215 => 117,  212 => 116,  209 => 115,  206 => 114,  202 => 112,  200 => 111,  189 => 109,  186 => 108,  183 => 107,  178 => 105,  173 => 103,  165 => 102,  161 => 101,  158 => 100,  155 => 99,  152 => 98,  149 => 97,  145 => 96,  140 => 93,  129 => 91,  122 => 26,  82 => 18,  78 => 53,  21 => 2,  142 => 43,  134 => 92,  128 => 36,  124 => 90,  105 => 32,  101 => 31,  96 => 30,  94 => 29,  89 => 28,  85 => 27,  74 => 15,  71 => 14,  65 => 43,  62 => 13,  56 => 10,  53 => 9,  50 => 8,  43 => 6,  40 => 5,  35 => 3,  32 => 2,);
    }
}
