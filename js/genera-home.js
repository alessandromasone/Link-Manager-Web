$(document).ready(function () {
    // Effettua una chiamata Ajax per ottenere la struttura ad albero dal server
    $.ajax({
        url: "php/genera-home.php", // Assumi che il tuo script PHP si chiami "genera_struttura.php"
        type: "GET",
        dataType: "html",
        success: function (response) {
            // Inserisci la risposta nel div "directoryTree"
            $("#directoryTree ul").html(response);
        },
        error: function (xhr, status, error) {
            console.log("Errore durante la chiamata Ajax:", error);
        }
    });
});
