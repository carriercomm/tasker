<?php

/* /applications/projects/layouts/calendar/task_today.html */
class __TwigTemplate_b02f5add9197f7370533a76d226a7f32 extends Twig_Template
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
        $this->env->loadTemplate("/source/jpaginator_boot.html")->display($context);
        // line 2
        echo \layout::func_from_text("<table class=\"table table-hover table-bordered table-condensed\">
    <tr>
        <th></th>
        <th>Проект</th>
        <th>Задача</th>
        <th>Статус</th>
        <th>Приоритет</th>
        <th>Статус выполнения</th>
        <th>Ответственный</th>
        <th>До окончания</th>
    </tr>
    ");
        // line 13
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tasks"]) ? $context["tasks"] : null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["task"]) {
            // line 14
            echo \layout::func_from_text("        <tr id=\"task");
            echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["task"]) ? $context["task"] : null), "id"), "html", null, true));
            echo \layout::func_from_text("\" ");
            if (($this->getAttribute((isset($context["task"]) ? $context["task"] : null), "type") == "error")) {
                echo \layout::func_from_text("class='error'");
            }
            echo \layout::func_from_text(">
            <td style=\"text-align: center;width: 10px;\">");
            // line 15
            if (($this->getAttribute((isset($context["task"]) ? $context["task"] : null), "task_creater") == $this->getAttribute($this->getAttribute((isset($context["globals"]) ? $context["globals"] : null), "user"), "id_user"))) {
                echo \layout::func_from_text("<i class=\"icon-user\" style=\"font-size: 20px;\"></i>");
            }
            echo \layout::func_from_text("</td>
            <td><a href=\"/projects/~");
            // line 16
            echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["task"]) ? $context["task"] : null), "id_project"), "html", null, true));
            echo \layout::func_from_text("/\">");
            echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["task"]) ? $context["task"] : null), "project_name"), "html", null, true));
            echo \layout::func_from_text("</a></td>
            <td><a href=\"/projects/tasks/show/");
            // line 17
            echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["task"]) ? $context["task"] : null), "id"), "html", null, true));
            echo \layout::func_from_text("/\">");
            echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["task"]) ? $context["task"] : null), "name"), "html", null, true));
            echo \layout::func_from_text("</a></td>
            <td>
                ");
            // line 19
            if (($this->getAttribute((isset($context["task"]) ? $context["task"] : null), "status") == "new")) {
                echo \layout::func_from_text("новая
                ");
            } elseif (($this->getAttribute((isset($context["task"]) ? $context["task"] : null), "status") == "in_progress")) {
                // line 20
                echo \layout::func_from_text("в процессе
                ");
            } elseif (($this->getAttribute((isset($context["task"]) ? $context["task"] : null), "status") == "closed")) {
                // line 21
                echo \layout::func_from_text("закрытая
                ");
            } elseif (($this->getAttribute((isset($context["task"]) ? $context["task"] : null), "status") == "rejected")) {
                // line 22
                echo \layout::func_from_text("отклоненная
                    <i class=\"icon icon-info-sign get_info\" rel=\"popover\" data-original-title=\"Причина отклонения\" data-content=\"");
                // line 23
                echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["task"]) ? $context["task"] : null), "message"), "html", null, true));
                echo \layout::func_from_text("\"></i>
                ");
            }
            // line 25
            echo \layout::func_from_text("            </td>
            <td>
                ");
            // line 27
            if (($this->getAttribute((isset($context["task"]) ? $context["task"] : null), "priority") == "1")) {
                echo \layout::func_from_text("<span class=\"label\">низкий</span>
                ");
            } elseif (($this->getAttribute((isset($context["task"]) ? $context["task"] : null), "priority") == "2")) {
                // line 28
                echo \layout::func_from_text("<span class=\"label label-success\">обычный</span>
                ");
            } elseif (($this->getAttribute((isset($context["task"]) ? $context["task"] : null), "priority") == "3")) {
                // line 29
                echo \layout::func_from_text("<span class=\"label label-warning\">высокий</span>
                ");
            } elseif (($this->getAttribute((isset($context["task"]) ? $context["task"] : null), "priority") == "4")) {
                // line 30
                echo \layout::func_from_text("<span class=\"label label-important\">критический</span>
                ");
            }
            // line 32
            echo \layout::func_from_text("            </td>
            <td>
                ");
            // line 34
            $context["undate"] = false;
            // line 35
            echo \layout::func_from_text("                ");
            if (($this->getAttribute((isset($context["task"]) ? $context["task"] : null), "end") && ((twig_date_format_filter($this->env, (isset($context["now"]) ? $context["now"] : null), "Y-m-d") > $this->getAttribute((isset($context["task"]) ? $context["task"] : null), "end")) && (($this->getAttribute((isset($context["task"]) ? $context["task"] : null), "status") == "new") || ($this->getAttribute((isset($context["task"]) ? $context["task"] : null), "status") == "in_progress"))))) {
                // line 36
                echo \layout::func_from_text("                    ");
                $context["undate"] = true;
                // line 37
                echo \layout::func_from_text("                ");
            }
            // line 38
            echo \layout::func_from_text("
                <div class=\"progress progress-striped ");
            // line 39
            if ((isset($context["undate"]) ? $context["undate"] : null)) {
                echo \layout::func_from_text("progress-danger");
            }
            echo \layout::func_from_text(" ");
            if (($this->getAttribute((isset($context["task"]) ? $context["task"] : null), "status") == "in_progress")) {
                echo \layout::func_from_text("active");
            }
            echo \layout::func_from_text("\">
                    <div class=\"bar\" style=\"width: ");
            // line 40
            if (($this->getAttribute((isset($context["task"]) ? $context["task"] : null), "percent") > 0)) {
                echo \layout::func_from_text("0%;");
            } else {
                echo \layout::func_from_text("30px;");
            }
            echo \layout::func_from_text("text-align: right;\" ");
            if (($this->getAttribute((isset($context["task"]) ? $context["task"] : null), "percent") > 0)) {
                echo \layout::func_from_text("data-width=\"");
                echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["task"]) ? $context["task"] : null), "percent"), "html", null, true));
                echo \layout::func_from_text("\"");
            }
            echo \layout::func_from_text(">
                        <span class=\"progress_text\">");
            // line 41
            echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["task"]) ? $context["task"] : null), "percent"), "html", null, true));
            echo \layout::func_from_text(" %</span>
                    </div>
                </div>
            </td>
            <td>
                <a href=\"/users/~");
            // line 46
            echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["task"]) ? $context["task"] : null), "assigned"), "html", null, true));
            echo \layout::func_from_text("/\" style=\"color:");
            echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["task"]) ? $context["task"] : null), "color"), "html", null, true));
            echo \layout::func_from_text(" !important;font-weight: bold;\" title=\"");
            echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["task"]) ? $context["task"] : null), "group_name"), "html", null, true));
            echo \layout::func_from_text("\">");
            echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["task"]) ? $context["task"] : null), "assigned_name"), "html", null, true));
            echo \layout::func_from_text("</a>
                <div class=\"nickname\">");
            // line 47
            echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["task"]) ? $context["task"] : null), "assigned_nickname"), "html", null, true));
            echo \layout::func_from_text("</div>
            </td>
            <td>");
            // line 49
            if ((isset($context["undate"]) ? $context["undate"] : null)) {
                echo \layout::func_from_text("просрочен");
            }
            echo \layout::func_from_text(" ");
            if ((($this->getAttribute((isset($context["task"]) ? $context["task"] : null), "diff") != "0") && ($this->getAttribute((isset($context["task"]) ? $context["task"] : null), "diff") != "inf"))) {
                echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["task"]) ? $context["task"] : null), "diff"), "html", null, true));
                echo \layout::func_from_text(" ");
                echo \layout::func_from_text(twig_escape_filter($this->env, lang("days", $this->getAttribute((isset($context["task"]) ? $context["task"] : null), "diff")), "html", null, true));
            } elseif (($this->getAttribute((isset($context["task"]) ? $context["task"] : null), "diff") == "inf")) {
                echo \layout::func_from_text("&infin;");
            } else {
                echo \layout::func_from_text("сегодня");
            }
            echo \layout::func_from_text("</td>
        </tr>
    ");
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 52
            echo \layout::func_from_text("        <tr>
            <td colspan=\"6\">Задачи не найдены</td>
        </tr>
    ");
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['task'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 56
        echo \layout::func_from_text("</table>
");
        // line 57
        $this->env->loadTemplate("/source/jpaginator_boot.html")->display($context);
        // line 58
        echo \layout::func_from_text("<script>
    \$(document).ready(function (\$) {
        animate_progress_bars();
    });
</script>");
    }

    public function getTemplateName()
    {
        return "/applications/projects/layouts/calendar/task_today.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  208 => 58,  206 => 57,  203 => 56,  194 => 52,  174 => 49,  169 => 47,  151 => 41,  137 => 40,  124 => 38,  118 => 36,  115 => 35,  113 => 34,  105 => 30,  101 => 29,  92 => 27,  83 => 23,  80 => 22,  72 => 20,  67 => 19,  54 => 16,  34 => 13,  21 => 2,  91 => 22,  85 => 21,  56 => 19,  53 => 18,  49 => 17,  45 => 15,  39 => 14,  33 => 10,  27 => 7,  19 => 1,  159 => 46,  155 => 44,  152 => 43,  148 => 30,  145 => 29,  140 => 4,  135 => 53,  133 => 52,  128 => 50,  125 => 49,  121 => 37,  116 => 45,  114 => 43,  97 => 28,  76 => 21,  70 => 22,  64 => 21,  58 => 20,  44 => 16,  42 => 15,  28 => 4,  23 => 1,  48 => 15,  38 => 7,  32 => 3,  29 => 8,  153 => 52,  144 => 48,  136 => 45,  130 => 51,  127 => 39,  122 => 42,  112 => 34,  109 => 32,  100 => 31,  94 => 28,  88 => 25,  82 => 24,  74 => 23,  68 => 22,  63 => 19,  60 => 17,  55 => 15,  52 => 19,  40 => 8,  37 => 12,  31 => 3,);
    }
}
