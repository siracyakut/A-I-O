	if not A_IsAdmin
	{
		Run *RunAs "%A_ScriptFullPath%"
		ExitApp
	}
#NoEnv
#Singleinstance, force
DetectHiddenWindows, On
SetTitleMatchMode, 2
SendMode Input
SetWorkingDir %A_ScriptDir%

;======================================
;Variables
;======================================

image_name=ward.png

;======================================
;CoordMode
;======================================
; if you change the value after 'if' to 1, all coordinates will be relative to screen/monitor
; if you leave the value at 0, all coordinates will be relative to current window

if 1	; screen coordinates
  coord=screen
else
  coord=relative

CoordMode, ToolTip, %coord%
CoordMode, Pixel, %coord%
CoordMode, Mouse, %coord%
CoordMode, Caret, %coord%
CoordMode, Menu, %coord%

;======================================
;ImageSearch
;======================================
MButton::
ImageSearch, FoundX, FoundY, 0, 0, 1366, 768, *10 %image_name%

if ErrorLevel = 2
    While GetKeyState("MButton","P")
	{
		Send 4
		Sleep 15
		Send w
	}
else if ErrorLevel = 1
    While GetKeyState("MButton","P")
	{
		Send 4
		Sleep 15
		Send w
	}
else
{
	While GetKeyState("MButton","P")
	{
		Send 7
		Sleep 15
		Send w
	}
}
return

END::
	msgbox script closed by user
exitapp
