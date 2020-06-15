/* Show / Hide Managers Section ======= */
$(function(){
    $("#mng-btn").click(function(){
    $("#mgrs-section").toggle(500);
    $(this).text($(this).text() == 'Meet our Managers' ? 'Close' : 'Meet our Managers');})
    // $("#mng-btn").css({"border-width": "0"});
});

/* Show / Hide FORM ======= */
function openUpdMngrForm() {
    document.getElementById("UpdMngrForm").style.display = "block";
    document.getElementById("overlay").style.display = "block";
}
function openBookTourForm() {
    document.getElementById("BookTourForm").style.display = "block";
    document.getElementById("overlay").style.display = "block";
}

function openAddMngrForm(){
    document.getElementById("AddMngrForm").style.display = "block";
    document.getElementById("overlay").style.display = "block";

}

function closeForm() {
    document.getElementsByClassName("form-popup").style.display = "none";
    document.getElementById("overlay").style.display = "none";
}