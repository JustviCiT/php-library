$(".deleteButton").click(function() {
    url = $(this).data("key")
    $("#mainLink").attr("href", url); 
})