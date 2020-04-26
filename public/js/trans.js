/*!
 * trans.js
 * http://purplegene.com/
 *
 * Copyright 2011, Markandey Singh @markandey
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * Released under the MIT, BSD, and GPL Licenses.
 *
 * Date: Feb 9 2011
 */

/***************************
Function SuperTrim
Description 
****************************/
function SuperTrim(str) {
    return str.replace(/^\s*|\s*$/g,'').replace(/\s+/g,' ');
}
function findstr(str,tofind){
    for (var i = 0; i < str.length; i++)
        if (str[i] == tofind)
            return true;
    return false;
}
/***************************
Function isConsonent
Description 
****************************/
function isConsonent(a, hflag) {
    var str = "aieouh";
    return !findstr(str,a);
}
/***************************
Function isTrueVowel
Description 
****************************/
function isTrueVowel( /*char*/ a) {
    var str = "aieou";
    return findstr(str,a);
}
/***************************
Function isDigit
Description 
****************************/
function isDigit( /*char*/ a) {
    var str = "0123456789";
    return findstr(str,a);
}
/***************************
Function isPunct
Description 
****************************/
function isPunct( /*char*/ a) {
    var str = ",.><?/+=-_}{[]*&^%$#@!~`\"\\|:;";
    return findstr(str,a);
}
/***************************
Function isVowel
Description 
****************************/
function isVowel( /*char*/ a) {
    var str = "aieouh";
   return findstr(str,a);
}
/***************************
Function isSpecial
Description 
****************************/
function isSpecial( /*char*/ a) {
    var str = "hy";
   return findstr(str,a);
}
/***************************
Function GetMatra
Description 
****************************/
function GetMatra(str) {
    var i = 0;
    if (str.length < 1) {
        return "्";
    }
    while (str[i] == 'h') {
        i++;
        if (i >= str.length) {
            break;
        }
    }
    if (i < str.length) {
        str = str.substring(i);
    }
    var matramap={
        "aa":'ा',
        "ai":'ै',
        "e":'े',
        "ee":'ी',
        'au':'ौ',
        "i":'ि',
        "u":'ु',
        "oo":'ू',
        "o":'ो',
        "h":'',
        "hh":''
    }
    //ौ
    if(matramap[str]!==undefined){
        return matramap[str];
    }
    return "";
}
/***************************
Function GethShift
Description 
****************************/
function GethShift(str) {
    //खगघङचछजटठडढणतथदधनपफमयरऱलवशषसह
    if (str.indexOf("kh") == 0) {
        var coresnd = "ख";
        return {
            "CoreSound": coresnd,
            "len": 2
        };
    }
    else if (str.indexOf("gh") == 0) {
        var coresnd = "घ";
        return {
            "CoreSound": coresnd,
            "len": 2
        };
    }
    else if (str.indexOf("bh") == 0) {
        var coresnd = "भ";
        return {
            "CoreSound": coresnd,
            "len": 2
        };
    }
    else if (str.indexOf("chh") == 0) {
        var coresnd = "छ";
        return {
            "CoreSound": coresnd,
            "len": 3
        };
    }
    else if (str.indexOf("ch") == 0) {
        var coresnd = "च";
        return {
            "CoreSound": coresnd,
            "len": 2
        };
    }
    else if (str.indexOf("jh") == 0) {
        var coresnd = "झ";
        return {
            "CoreSound": coresnd,
            "len": 2
        };
    }
    else if (str.indexOf("thh") == 0) {
        var coresnd = "ट";
        return {
            "CoreSound": coresnd,
            "len": 3
        };
    }
    else if (str.indexOf("th") == 0) {
        var coresnd = "थ";
        return {
            "CoreSound": coresnd,
            "len": 2
        };
    }
    else if (str.indexOf("gh") == 0) {
        var coresnd = "घ";
        return {
            "CoreSound": coresnd,
            "len": 2
        };
    }
    else if (str.indexOf("dhh") == 0) {
        len = 3;
        var coresnd = "ड";
        return {
            "CoreSound": coresnd,
            "len": 2
        };
    }
    else if (str.indexOf("dh") == 0) {
        var coresnd = "ध";
        return {
            "CoreSound": coresnd,
            "len": 2
        };
    }
    else if (str.indexOf("shh") == 0) {
        var coresnd = "ष";
        return {
            "CoreSound": coresnd,
            "len": 3
        };
    }
    else if (str.indexOf("sh") == 0) {
        var coresnd = "श";
        return {
            "CoreSound": coresnd,
            "len": 2
        };
    }
    else if (str.indexOf("rh") == 0) {
        var coresnd = "ण";
        return {
            "CoreSound": coresnd,
            "len": 2
        };
    }
    else if (str.indexOf("h") >= 1) {
/*
		 * VERY IMORTANT STEP
		 * */
        var sound = "";
        var len = 0;
        var index = 0;
        for (index = 0; index < str.length; index++) {
            var c = str[index];
            if (!isTrueVowel(c)) {
                sound = sound + ResolveCharacterSound(c);
                len++;
            }
            else {
                break;
            }
        }
        return {
            "CoreSound": sound,
            "len": len
        };
    }
    return {
        "CoreSound": null,
        "len": 1
    };
}
/***************************
Function GetCoreSound
Description 
****************************/
function GetCoreSound(str) {
    var soundmap = "अबसदइफगहईजकलमनओपकरसतउववज़यज";
    var len = 1;
    var h_shift = GethShift(str);
    if (h_shift["CoreSound"] == null) {
        var position = ((str.charCodeAt(0)) - 'a'.charCodeAt(0));
        if (position < soundmap.length && position >= 0) {
            var coresnd = "" + soundmap[position];
            return {
                "CoreSound": coresnd,
                "len": len
            };
        }
        len = 1;
        return {
            "CoreSound": str,
            "len": len
        };
    }
    else {
        return h_shift;
    }
}
function GetSpecialSound(str) {
    //अआइईउऊऑऒओऔ
    specialsoundMap={
        "aa":"आ",
        "ai":"ए",
        "aai":"ऐ",
        "au":"औ",
        "e":"इ",
        "ee":"ई",
        "i":"इ",
        "o":"ओ",
        "x":"एक्स"
    }
    if(specialsoundMap[str]!==undefined){
        return specialsoundMap[str];
    }
    return null;
}
/***************************
Function Description 
****************************/
function ResolveCharacterSound( /*char*/ c) {
    var str = "" + c;
    var len = 0;
    if (isPunct(c)) {
        return str;
    }
    else if (isDigit(c)) {
        return "" + ((c - '0'));
    }
    else if (isConsonent(str[0], false)) {
        return "" + GetCoreSound(str).CoreSound + "्";
    }
    else {
        return "" + GetCoreSound(str).CoreSound;
    }
}
/***************************
Function Description 
****************************/
function GetSound(str) {
    var len = 0;
    str = SuperTrim(str.toLowerCase());
    if (str == null || str == "") {
        return "";
    }
    var SpecialSound = GetSpecialSound(str);
    if (SpecialSound != null) {
        return SpecialSound;
    }
    if (str.length == 1) {
        return ResolveCharacterSound(str[0]);
    }
    else {
        var core_sound = GetCoreSound(str);
        var matra = "";
        if (core_sound.len >= 1) {
            matra = GetMatra(str.substring(core_sound.len));
        }
        else {
            matra = "";
        }
        return "" + core_sound.CoreSound + matra;
    }
    //return str;
}
/***************************
Function Description 
****************************/
function DoTransLitrate(str) {
    var i = 0;
    var ret = "";
    var pi = 0;
    var vowelFlag = false;
    str = SuperTrim(str.toLowerCase());
    while (i < str.length) {
        if ((str[i] == 'h' && vowelFlag) || (isConsonent(str[i], vowelFlag) && i > 0) || (str[i] == ' ') || isPunct(str[i]) || isDigit(str[i]) || ((i - pi) > 5)) {
            if (pi < i) {
                ret += GetSound(str.substring(pi, i));
            }
            if (str[i] == ' ') {
                ret += ' ';
            }
            if (((str[i] == ' ') || isPunct(str[i]))) {
                ret += str[i];
                pi = i + 1;
            }
            else if (isDigit(str[i])) {
                var digi = "" + ((str[i] - '0'));
                ret += digi;
                pi = i + 1;
            }
            else {
                pi = i;
            }
            vowelFlag = false;
        }
        else if (isVowel(str[i]) && str[i] != 'h') {
            vowelFlag = true;
        }
	i=i+1;
    }
    if (pi < i) {
        ret += GetSound(str.substring(pi, i));
    }
    return SuperTrim(ret);
}
