<?php
$ThemeName = ""; //would be the same as the name of the DIR with the themes files
$ThemeDirectory = ""; // '/themes' by default
$Bootstrap = 1; // toggle on or off
$JQM = ""; // toggle on or off

function checkBSJQ(){
    if(Bootstrap) {
       return "BS";
    } elseif (JQM) {
        return "JQ"
    } else {return false}

}
echo checkBSJQ();

// Define Classes and IDs (with Bootstrap [starter-template])
/*$headerClass = "starter-template";
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
A function that checks if Bootstrap enabled.. if yes, it enables the starter-template by appllying these classes (update the above vars,)
and of course adds the necessary metadata and sheets and scripts.. the HEADER bit to be precise.
if Not enabled, it checks for JQM.. if that's enabled.. it might do similar shit.
If neither, it merely string together the address using ThemeName and Dir, and leaves the class vars be.

The vars would be used in place of class names.
Function somewhere in Head tag.. main return would be the Stylesheet and script linking markup.

Make it even simpler.. add everything... all can be toggled simply by setting vars to yes/no, true/false, 0/1 and shit
*/

?>