// JavaScript Document

$("#refresh-captcha").click(function(e){
	"use strict";
	e.preventDefault();
$(".captcha-img").attr("src", $(".captcha-img").attr("src")+"?ver=" + new Date().getTime());

});