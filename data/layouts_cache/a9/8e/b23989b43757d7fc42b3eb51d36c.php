<?php

/* /source/admin/index.html */
class __TwigTemplate_a98eb23989b43757d7fc42b3eb51d36c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'css' => array($this, 'block_css'),
            'body' => array($this, 'block_body'),
            'js' => array($this, 'block_js'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo \layout::func_from_text("<!DOCTYPE html>
<html lang=\"en\">
\t
<!-- Mirrored from bootstrapstyler.com/preview/_/hyperia/ by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 24 Jan 2014 02:08:02 GMT -->
<!-- Added by HTTrack --><meta http-equiv=\"content-type\" content=\"text/html;charset=UTF-8\" /><!-- /Added by HTTrack -->
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">

    <title>Панель управления сайтом</title>

    <link rel=\"stylesheet\" href=\"/source/css/jquery.jgrowl.css\" type=\"text/css\" media=\"screen, projection\" />
    <link rel=\"stylesheet\" href=\"/source/css/popup.css\" type=\"text/css\" media=\"screen, projection\" />

    <!-- Bootstrap core CSS -->
    <link href=\"/source/admin/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">

    <!-- Font Awesome CSS -->
    <link href=\"/source/admin/fonts/font-awesome/css/font-awesome.minba72.css?v=4.0.3\" rel=\"stylesheet\">

    <!-- Animate CSS -->
    <link href=\"/source/admin/css/libs/animate.min.css\" rel=\"stylesheet\">

    <!-- Bootstrap Switch -->
    <link href=\"/source/admin/css/libs/bootstrap-switch.css\" rel=\"stylesheet\">

    <!-- Custom styles for this template -->
    <link rel=\"stylesheet\" href=\"/source/js/styler/jquery.formstyler.css\" type=\"text/css\" />
    <link href=\"/source/admin/css/styler/style.css\" rel=\"stylesheet\" type=\"text/css\">
    <link rel=\"stylesheet\" href=\"/source/css/jquery-ui.min.css\" type=\"text/css\">
    ");
        // line 34
        $this->displayBlock('css', $context, $blocks);
        // line 35
        echo \layout::func_from_text("

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
        <script src=\"https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js\"></script>
    <![endif]-->
</head>

<body>
<div class=\"top_div\">
    <i class=\"navbar-toggle2 fa fa-bars\" data-toggle=\"side-menu\" data-target=\"#sidebar\"></i>
    <span>Панель управления сайтом <a href=\"/\" target=\"_blank\">");
        // line 47
        echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "site_name"), "value"), "html", null, true));
        echo \layout::func_from_text("</a></span>
</div>

<div id=\"wrapper\">
<div id=\"sidebar\">
\t<div class=\"inner\">
\t\t<nav class=\"side-nav\">
\t\t\t<ul class=\"nav nav-pills nav-stacked user-bar\">
\t\t\t\t<li>
\t\t\t\t\t<a href=\"#user-menu\" data-toggle=\"collapse\" class=\"dropdown-toggle\">
\t\t\t\t\t\t\t<div class=\"user-name\">");
        // line 57
        echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["globals"]) ? $context["globals"] : null), "admin"), "fio"), "html", null, true));
        echo \layout::func_from_text("</div>
\t\t\t\t\t\t\t<div class=\"\" style=\"color:");
        // line 58
        echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["globals"]) ? $context["globals"] : null), "admin"), "group_color"), "html", null, true));
        echo \layout::func_from_text(";margin-bottom: 0px;\">");
        echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["globals"]) ? $context["globals"] : null), "admin"), "group_name"), "html", null, true));
        echo \layout::func_from_text("</div>
                        <b class=\"caret\"></b>
\t\t\t\t\t</a>
\t\t\t\t\t<ul class=\"panel-collapse collapse\" id=\"user-menu\">
\t\t\t\t\t\t<li><a href=\"\" change_admin_pass><i class=\"fa fa-user\"></i> Изменить пароль</a></li>
\t\t\t\t\t\t<li><a href=\"/admin/index/logout/\"><i class=\"fa fa-sign-out\"></i> Выход</a></li>
\t\t\t\t\t</ul>
\t\t\t\t</li>
\t\t\t</ul>
\t\t</nav>
\t\t<!--
\t\t<nav class=\"navbar navbar-inverse user-notification\">
\t\t\t<div class=\"\">
\t\t\t\t<ul class=\"nav navbar-nav\">
\t\t\t\t\t<li class=\"dropdown\">
\t\t\t\t\t\t<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"tooltip\" title=\"Friend Requests\" data-placement=\"bottom\" data-trigger=\"hover\">
\t\t\t\t\t\t\t<i class=\"fa fa-users\"></i>
\t\t\t\t\t\t</a>
\t\t\t\t\t</li>
\t\t\t\t\t<li class=\"dropdown\">
\t\t\t\t\t\t<a href=\"tasks.html\" class=\"dropdown-toggle\" data-toggle=\"tooltip\" title=\"My Tasks\" data-placement=\"bottom\" data-trigger=\"hover\">
\t\t\t\t\t\t\t<i class=\"fa fa-th-list\"></i>
\t\t\t\t\t\t\t<span class=\"badge badge-info\">1</span>
\t\t\t\t\t\t</a>
\t\t\t\t\t</li>
\t\t\t\t\t<li class=\"dropdown\">
\t\t\t\t\t\t<a href=\"messages.html\" class=\"dropdown-toggle\" data-toggle=\"tooltip\" title=\"Messages\" data-placement=\"bottom\" data-trigger=\"hover\">
\t\t\t\t\t\t\t<i class=\"fa fa-envelope\"></i>
\t\t\t\t\t\t\t<span class=\"badge badge-danger\">4</span>
\t\t\t\t\t\t</a>
\t\t\t\t\t</li>
\t\t\t\t</ul>
\t\t\t</div>
\t\t</nav>
\t\t-->
        ");
        // line 93
        $context["submenu"] = "";
        // line 94
        echo \layout::func_from_text("        ");
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["globals"]) ? $context["globals"] : null), "root_menu"));
        foreach ($context['_seq'] as $context["k"] => $context["r_m"]) {
            // line 95
            echo \layout::func_from_text("            ");
            if (($this->getAttribute((isset($context["r_m"]) ? $context["r_m"] : null), "submenu") && ((isset($context["k"]) ? $context["k"] : null) == $this->getAttribute((isset($context["globals"]) ? $context["globals"] : null), "menu")))) {
                $context["submenu"] = $this->getAttribute((isset($context["r_m"]) ? $context["r_m"] : null), "submenu");
            }
            // line 96
            echo \layout::func_from_text("        ");
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['r_m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 97
        echo \layout::func_from_text("
        <nav class=\"side-nav\">
            <ul class=\"nav nav-pills nav-stacked\">
                ");
        // line 100
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["submenu"]) ? $context["submenu"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 101
            echo \layout::func_from_text("                    ");
            if ((($this->getAttribute((isset($context["m"]) ? $context["m"] : null), "count") > 1) && ($this->getAttribute((isset($context["m"]) ? $context["m"] : null), "category") != ""))) {
                // line 102
                echo \layout::func_from_text("                        ");
                if (((isset($context["category"]) ? $context["category"] : null) != $this->getAttribute((isset($context["m"]) ? $context["m"] : null), "category"))) {
                    // line 103
                    echo \layout::func_from_text("                            ");
                    $context["count"] = 1;
                    // line 104
                    echo \layout::func_from_text("                            <li>
                                <a href=\"#");
                    // line 105
                    echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["m"]) ? $context["m"] : null), "category"), "html", null, true));
                    echo \layout::func_from_text("\" data-toggle=\"collapse\" data-parent=\".side-nav\" class=\"collapsed\">
                                    <i class=\"fa fa-fw fa-15x ");
                    // line 106
                    if ($this->getAttribute((isset($context["m"]) ? $context["m"] : null), "icon")) {
                        echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["m"]) ? $context["m"] : null), "icon"), "html", null, true));
                    } else {
                        echo \layout::func_from_text("fa-list-ul");
                    }
                    echo \layout::func_from_text("\"></i>
                                    <span class=\"fa-12x\">");
                    // line 107
                    echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["m"]) ? $context["m"] : null), "category"), "html", null, true));
                    echo \layout::func_from_text("</span> <b class=\"caret\"></b>
                                </a>
                            <ul class=\"panel-collapse in\" id=\"");
                    // line 109
                    echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["m"]) ? $context["m"] : null), "category"), "html", null, true));
                    echo \layout::func_from_text("\">
                        ");
                }
                // line 111
                echo \layout::func_from_text("                        ");
                $context["category"] = $this->getAttribute((isset($context["m"]) ? $context["m"] : null), "category");
                // line 112
                echo \layout::func_from_text("
                        <li ");
                // line 113
                if (($this->getAttribute((isset($context["m"]) ? $context["m"] : null), "url") == $this->getAttribute((isset($context["globals"]) ? $context["globals"] : null), "submenu"))) {
                    echo \layout::func_from_text("class=\"active\"");
                }
                echo \layout::func_from_text("><a href=\"/admin/");
                echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["m"]) ? $context["m"] : null), "url"), "html", null, true));
                echo \layout::func_from_text("\"><i class=\"fa fa-fw fa-arrow-right\" style=\"margin-top: -3px;\"></i> <span>");
                echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["m"]) ? $context["m"] : null), "name"), "html", null, true));
                echo \layout::func_from_text("</span></a></li>

                        ");
                // line 115
                if (((isset($context["count"]) ? $context["count"] : null) == $this->getAttribute((isset($context["m"]) ? $context["m"] : null), "count"))) {
                    // line 116
                    echo \layout::func_from_text("                            </ul></li>
                        ");
                } else {
                    // line 118
                    echo \layout::func_from_text("                            ");
                    $context["count"] = ((isset($context["count"]) ? $context["count"] : null) + 1);
                    // line 119
                    echo \layout::func_from_text("                        ");
                }
                // line 120
                echo \layout::func_from_text("                    ");
            } else {
                // line 121
                echo \layout::func_from_text("                        <li ");
                if (($this->getAttribute((isset($context["m"]) ? $context["m"] : null), "url") == $this->getAttribute((isset($context["globals"]) ? $context["globals"] : null), "submenu"))) {
                    echo \layout::func_from_text("class=\"active\"");
                }
                echo \layout::func_from_text(">
                            <a href=\"/admin/");
                // line 122
                echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["m"]) ? $context["m"] : null), "url"), "html", null, true));
                echo \layout::func_from_text("\">
                                <i class=\"fa fa-fw fa-15x ");
                // line 123
                if ($this->getAttribute((isset($context["m"]) ? $context["m"] : null), "icon")) {
                    echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["m"]) ? $context["m"] : null), "icon"), "html", null, true));
                } else {
                    echo \layout::func_from_text("fa-list-ul");
                }
                echo \layout::func_from_text("\"></i>
                                <span class=\"fa-12x\">");
                // line 124
                echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["m"]) ? $context["m"] : null), "name"), "html", null, true));
                echo \layout::func_from_text("</span>
                            </a>
                        </li>
                    ");
            }
            // line 128
            echo \layout::func_from_text("                ");
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 129
        echo \layout::func_from_text("            </ul>
        </nav>
<!--
\t\t<nav class=\"side-nav\">
\t\t\t<ul class=\"nav nav-pills nav-stacked\">
\t\t\t\t<li >
\t\t\t\t\t<a href=\"index-2.html\">
\t\t\t\t\t\t<i class=\"fa fa-dashboard\"></i>
\t\t\t\t\t\tDashboard
\t\t\t\t\t</a>
\t\t\t\t</li>

\t\t\t\t<li>
\t\t\t\t\t<a href=\"#tasks\" data-toggle=\"collapse\" data-parent=\".side-nav\" class=\"collapsed\">
\t\t\t\t\t\t<i class=\"fa fa-list-ul\"></i>
\t\t\t\t\t\tTask Lists <b class=\"caret\"></b>
\t\t\t\t\t</a>
\t\t\t\t\t<ul class=\"panel-collapse collapse \" id=\"tasks\">
\t\t\t\t\t\t<li ><a href=\"tasks.html\"><i class=\"fa fa-arrow-right\"></i> Task inside Panel</a></li>
\t\t\t\t\t\t<li ><a href=\"tasks-alt.html\"><i class=\"fa fa-arrow-right\"></i> Task without Panel</a></li>
\t\t\t\t\t</ul>
\t\t\t\t</li>

\t\t\t\t<li>
\t\t\t\t\t<a href=\"#messages\" data-toggle=\"collapse\" data-parent=\".side-nav\" class=\"collapsed\">
\t\t\t\t\t\t<i class=\"fa fa-comments\"></i>
\t\t\t\t\t\tMessages <b class=\"caret\"></b>
\t\t\t\t\t</a>
\t\t\t\t\t<ul class=\"panel-collapse collapse \" id=\"messages\">
\t\t\t\t\t\t<li ><a href=\"messages.html\"><i class=\"fa fa-arrow-right\"></i> Messages inside Panel</a></li>
\t\t\t\t\t\t<li ><a href=\"messages-alt.html\"><i class=\"fa fa-arrow-right\"></i> Messages without Panel</a></li>
\t\t\t\t\t</ul>
\t\t\t\t</li>

\t\t\t\t<li >
\t\t\t\t\t<a href=\"charts.html\">
\t\t\t\t\t\t<i class=\"fa fa-bar-chart-o\"></i>
\t\t\t\t\t\tCharts
\t\t\t\t\t</a>
\t\t\t\t</li>

\t\t\t\t<li >
\t\t\t\t\t<a href=\"calendar.html\">
\t\t\t\t\t\t<i class=\"fa fa-calendar\"></i>
\t\t\t\t\t\tCalendar
\t\t\t\t\t</a>
\t\t\t\t</li>

\t\t\t\t<li>
\t\t\t\t\t<a href=\"#ui\" data-toggle=\"collapse\" data-parent=\".side-nav\" class=\"collapsed\">
\t\t\t\t\t\t<i class=\"icon-wand\"></i>
\t\t\t\t\t\tUI Elements <b class=\"caret\"></b>
\t\t\t\t\t</a>
\t\t\t\t\t<ul class=\"panel-collapse collapse \" id=\"ui\">
\t\t\t\t\t\t<li >
\t\t\t\t\t\t\t<a href=\"forms.html\">
\t\t\t\t\t\t\t\t<i class=\"fa fa-list-alt\"></i>
\t\t\t\t\t\t\t\tForms
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li >
\t\t\t\t\t\t\t<a href=\"typo.html\">
\t\t\t\t\t\t\t\t<i class=\"fa fa-font\"></i>
\t\t\t\t\t\t\t\tTypography
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</li>

\t\t\t\t\t\t<li >
\t\t\t\t\t\t\t<a href=\"icons.html\">
\t\t\t\t\t\t\t\t<i class=\"fa fa-picture-o\"></i>
\t\t\t\t\t\t\t\tIcons
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</li>

\t\t\t\t\t\t<li >
\t\t\t\t\t\t\t<a href=\"tables.html\">
\t\t\t\t\t\t\t\t<i class=\"fa fa-table\"></i>
\t\t\t\t\t\t\t\tTables
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</li>

\t\t\t\t\t\t<li >
\t\t\t\t\t\t\t<a href=\"panels.html\">
\t\t\t\t\t\t\t\t<i class=\"fa fa-th-large\"></i>
\t\t\t\t\t\t\t\tPanels
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t</ul>
\t\t\t\t</li>

\t\t\t\t<li>
\t\t\t\t\t<a href=\"#pages\" data-toggle=\"collapse\" data-parent=\".side-nav\" class=\"collapsed\">
\t\t\t\t\t\t<i class=\"icon-copy\"></i>
\t\t\t\t\t\tPages <b class=\"caret\"></b>
\t\t\t\t\t</a>
\t\t\t\t\t<ul class=\"panel-collapse collapse \" id=\"pages\">
\t\t\t\t\t\t<li ><a href=\"signup.html\"><i class=\"fa fa-arrow-right\"></i> Sign up</a></li>
\t\t\t\t\t\t<li ><a href=\"signin.html\"><i class=\"fa fa-arrow-right\"></i> Sign in</a></li>
\t\t\t\t\t\t<li ><a href=\"profile.html\"><i class=\"fa fa-arrow-right\"></i> Profile</a></li>
\t\t\t\t\t\t<li ><a href=\"404.html\"><i class=\"fa fa-arrow-right\"></i> Error 404</a></li>
\t\t\t\t\t</ul>
\t\t\t\t</li>
\t\t\t</ul>
\t\t</nav>

\t\t<div class=\"panel panel-outline\">
\t\t\t<div class=\"panel-body\">
\t\t\t\t<ul class=\"list-unstyled\">
\t\t\t\t\t
\t\t\t\t\t<li>
\t\t\t\t\t\tCPU Usage
\t\t\t\t\t\t<div class=\"progress\">
\t\t\t\t\t\t\t<div class=\"progress-bar progress-bar-info\" role=\"progressbar\" aria-valuenow=\"40\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 40%\">
\t\t\t\t\t\t\t\t<span class=\"sr-only\">40%</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</li>
\t\t\t\t\t<li>
\t\t\t\t\t\tRAM Usage
\t\t\t\t\t\t<div class=\"progress\">
\t\t\t\t\t\t\t<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"10\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 10%\">
\t\t\t\t\t\t\t\t<span class=\"sr-only\">10%</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</li>
\t\t\t\t\t<li>
\t\t\t\t\t\tBandwidth
\t\t\t\t\t\t<div class=\"progress\">
\t\t\t\t\t\t\t<div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" aria-valuenow=\"60\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 60%\">
\t\t\t\t\t\t\t\t<span class=\"sr-only\">60%</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</li>
\t\t\t\t\t<li>
\t\t\t\t\t\tHDD Space
\t\t\t\t\t\t<div class=\"progress\">
\t\t\t\t\t\t\t<div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" aria-valuenow=\"80\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 80%\">
\t\t\t\t\t\t\t\t<span class=\"sr-only\">80%</span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</li>
\t\t\t\t</ul>
\t\t\t</div>
\t\t</div>-->
\t</div>
</div>
<div id=\"middle\">
\t<header id=\"header\">
        <nav class=\"navbar navbar-default\">
            <div class=\"navbar-switcher\">
                <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"side-menu\" data-target=\"#sidebar\">
                    <span class=\"sr-only\">Toggle Sidebar</span>
                    <i class=\"fa fa-bars\"></i>
                </button>
            </div>

            <div class=\"navbar-switcher navbar-switcher-right\">
                <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#topnav\">
                    <span class=\"sr-only\">Toggle Menu</span>
                    <i class=\"fa fa-bars\"></i>
                </button>
            </div>
            <div class=\"navbar-header\">

            </div>
            <div class=\"collapse navbar-collapse\" id=\"topnav\">
                <ul class=\"nav navbar-nav\">
                    ");
        // line 296
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["globals"]) ? $context["globals"] : null), "root_menu"));
        foreach ($context['_seq'] as $context["k"] => $context["r_m"]) {
            // line 297
            echo \layout::func_from_text("                        <li ");
            if (($this->getAttribute((isset($context["globals"]) ? $context["globals"] : null), "menu") == (isset($context["k"]) ? $context["k"] : null))) {
                echo \layout::func_from_text("class=\"active\"");
            }
            echo \layout::func_from_text(" style=\"position: relative;\">
                            <a href=\"");
            // line 298
            if ((!$this->getAttribute((isset($context["r_m"]) ? $context["r_m"] : null), "url"))) {
                echo \layout::func_from_text("/admin/~");
                echo \layout::func_from_text(twig_escape_filter($this->env, (isset($context["k"]) ? $context["k"] : null), "html", null, true));
                echo \layout::func_from_text("/");
            } else {
                echo \layout::func_from_text("/admin/");
                echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["r_m"]) ? $context["r_m"] : null), "url"), "html", null, true));
                echo \layout::func_from_text("/");
            }
            echo \layout::func_from_text("\" title=\"title\">");
            echo \layout::func_from_text(twig_escape_filter($this->env, $this->getAttribute((isset($context["r_m"]) ? $context["r_m"] : null), "name"), "html", null, true));
            echo \layout::func_from_text("</a>
                        </li>
                    ");
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['r_m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 301
        echo \layout::func_from_text("                </ul>
            </div>
        </nav>
    </header><!-- /#header -->
\t<div id=\"content\">
\t\t<div class=\"container\">
            ");
        // line 307
        $this->displayBlock('body', $context, $blocks);
        // line 308
        echo \layout::func_from_text("

\t\t</div><!-- /.container -->
\t</div>
\t<footer>
\t\t<div class=\"row\">
\t\t\t<div class=\"col-lg-12\">
\t\t\t\t
\t\t\t</div>
\t\t</div><!-- /.row -->
\t</footer>
</div>

</div><!-- /#wrapper -->
\t\t


\t\t<!-- jQuery -->
\t\t<script src=\"/source/js/jquery.min.js\"></script>

\t\t<!-- Bootstrap core JavaScript -->
\t\t<script src=\"/source/admin/bootstrap/js/bootstrap.min.js\"></script>

\t\t<!-- jQuery Transit -->
\t\t<script src=\"/source/admin/js/libs/jquery.transit.min692f.js?v=0.9.9\"></script>

\t\t<!-- Bootstrap Switch -->
\t\t<script src=\"/source/admin/js/libs/bootstrap-switch.js\"></script>

\t\t<!-- jQuery EqualHeights -->
\t\t<script src=\"/source/admin/js/libs/jquery.equalheights.min.js\"></script>

\t\t<!-- jQuery Nicescroll -->
\t\t<script src=\"/source/admin/js/libs/jquery.nicescroll.min.js\"></script>

\t\t<!-- Theme script -->
\t\t<script src=\"/source/admin/js/styler/script.js\"></script>

        <script src=\"/source/js/head.min.js\"></script>
        <script src=\"/source/js/styler/jquery.formstyler.js\"></script>
        <script>
            \$(document).ready(function(\$) {
                \$('#middle input, #middle select').styler();

                var randomColor = \"#000000\".replace(/0/g,function(){return (~~(Math.random()*16)).toString(16);});
                //\$(\".navbar-nav .active a\").css(\"background\",randomColor);
            });
        </script>
        <script>
            head.js(
                    \"/source/js/jquery-ui.min.js\",
                    \"/source/js/jquery.jgrowl_minimized.js\",
                    \"/source/js/functions.js\",
                    \"/applications/index/source/js/change_pass.js\",
                    \"/source/js/message.js\",
                    \"/applications/index/source/js/index_admin.js\"
                    ");
        // line 364
        $this->displayBlock('js', $context, $blocks);
        // line 365
        echo \layout::func_from_text("            );
        </script>

\t</body>

<!-- Mirrored from bootstrapstyler.com/preview/_/hyperia/ by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 24 Jan 2014 02:09:01 GMT -->
</html>");
    }

    // line 34
    public function block_css($context, array $blocks = array())
    {
    }

    // line 307
    public function block_body($context, array $blocks = array())
    {
    }

    // line 364
    public function block_js($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "/source/admin/index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  544 => 364,  539 => 307,  534 => 34,  524 => 365,  522 => 364,  464 => 308,  462 => 307,  454 => 301,  435 => 298,  428 => 297,  424 => 296,  255 => 129,  249 => 128,  242 => 124,  234 => 123,  230 => 122,  223 => 121,  220 => 120,  217 => 119,  214 => 118,  210 => 116,  208 => 115,  197 => 113,  194 => 112,  191 => 111,  186 => 109,  181 => 107,  173 => 106,  169 => 105,  166 => 104,  163 => 103,  160 => 102,  157 => 101,  153 => 100,  148 => 97,  142 => 96,  137 => 95,  132 => 94,  130 => 93,  90 => 58,  86 => 57,  73 => 47,  59 => 35,  57 => 34,  22 => 1,);
    }
}
