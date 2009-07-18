<?php
namespace phpdotnet\phd;

class Package_PHP_HowTo extends Package_PHP_Web {
    private $nav = "";

    public function __construct() {
        parent::__construct();
        $this->registerFormatName("PHP-HowTo");
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function header($id) {
        $title = Format::getShortDescription($id);
        $parent = Format::getParent($id);
        $next = $prev = $up = array(null, null);
        if ($parent && $parent != "ROOT") {
            $siblings = Format::getChildrens($parent);
            if ($nextId = Format::getNext($id)) {
                $next = array(
                    Format::getFilename($nextId) . '.' . $this->getExt(),
                    Format::getShortDescription($nextId),
                );
            }
            if ($prevId = Format::getPrevious($id)) {
                $prev = array(
                    Format::getFilename($prevId) . '.' . $this->getExt(),
                    Format::getShortDescription($prevId),
                );
            }
            $up = array($parent . '.' . $this->getExt(), Format::getShortDescription($parent));
        }

        $this->nav = <<<NAV
<div style="text-align: center;">
 <div class="prev" style="text-align: left; float: left;"><a href="{$prev[0]}">{$prev[1]}</a></div>
 <div class="next" style="text-align: right; float: right;"><a href="{$next[0]}">{$next[1]}</a></div>
 <div class="up"><a href="{$up[0]}">{$up[1]}</a></div>
</div>
NAV;
/*
        return "<?php include_once '../include/init.inc.php'; echo site_header('$title');?>\n" . $this->nav . "<hr />\n";
*/
        return "<?php include_once '../include/shared-manual.inc'; echo site_header('$title');?>\n" . $this->nav . "<hr />\n";
    }

    public function footer($id) {
        return "<hr />\n" . $this->nav . "<br />\n<?php echo site_footer(); ?>\n";
    }
}

?>