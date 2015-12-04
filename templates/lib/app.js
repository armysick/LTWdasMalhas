// JavaScript Document
//wait for the document to be loaded
$(document).ready(function(){
	setLinks(); //add a click list for any of the links
});
//every time the a is clicked something will happen
//instead of giving a different id and writing several different functions for each one
//this function will put a listen on each one of the menu links!!
//'e' hold all the information of the element clicked...
function setLinks(){
	$("nav ul li a").click(function(e){
		//e.preventDefault(); //remove any default operations from the 'a' links
		var sectionID = e.currentTarget.id + "Section"; //to add Section word to the current Target id
		//alert('button id ' + e.currentTarget.id);
		$("html body").animate({
			scrollTop: $("#" + sectionID).offset().top}, 1000)  //it finds out the offset and move it up in 1 second
		})
}