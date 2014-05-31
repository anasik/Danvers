<?php
$Bootstrap = 1; // toggle on or off
$JQM = false; // toggle on or off
$ThemeName = "bootstrap"; //would be the same as the name of the DIR with the themes files
$themeDir = "themes/" . $ThemeName;
$themeMarkup = file_get_contents($themeDir . "/markup.html");

function checkBSJQ(){
    global $Bootstrap;
    global $JQM;
    if($Bootstrap) {
       return "bs";
    } elseif ($JQM) {
        return "jq";
    } else {return "neither";}

}
function setTheme(){
    global $ThemeName, $ThemeMarkup;
    switch(checkBSJQ()) {
        case "bs":
            $ThemeName = "bootstrap";
            return $ThemeMarkup;
            break;
        case "jq":
            break;
        case "neither":
            break;
    }
}

// Define Classes and IDs (with Bootstrap [starter-template])
/*  $themeDir = $DefThemesDirectory . "/" . $ThemeName;
 * $themeMarkup = file_get_contents($themeDir . "/markup.html");

  $headerClass = "starter-template";
    $headerSubtitleClass = "lead";
$footerClass = "";
    $footerSpanClass = "text-muted";
$NavBARcLass = "navbar-header";
    $NavBarRespToggleClass = "navbar-toggle";
    $NavBarLogoON = "yes";
        $NavBarLogoClass = "navbar-brand";
    $NavBARListDivClass = "collapse navbar-collapse";
        $NavBARulClass = "nav navbar-nav";

*/
/*
A function that checks if Bootstrap enabled.. if yes, it enables the starter-template by applying these classes (update the above vars,)
and of course adds the necessary metadata and sheets and scripts.. the HEADER bit to be precise.
if Not enabled, it checks for JQM.. if that's enabled.. it might do similar shit.
If neither, it merely string together the address using ThemeName and Dir, and leaves the class vars be.

The vars would be used in place of class names.
Function somewhere in Head tag.. main return would be the Stylesheet and script linking markup.

Make it even simpler.. add everything... all can be toggled simply by setting vars to yes/no, true/false, 0/1 and shit

------
NEWSFLASH: started..
 1 func checks if the 2 are enabled.. if neither, it tells so..
another function carries a switch that calls teh first and decides.
maybe it can RETURN the markup, and set the vars...
and The next step seems naught but to define the vars.

Perhaps in the index file, in place of the stylesheet meta e.t.c. teh func can be called.. latter that is..
*/

?>