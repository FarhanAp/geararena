window.jsPDF = window.jspdf.jsPDF;
var docPDF = new jsPDF();

function printMyInvoice (invoiceNo) { 
    var elementHtml = document.querySelector("#myInvoice");
    docPDF.html( elementHtml, {
        callback: function() {
            docPDF.save(invoiceNo+'.pdf');
        },
        x: 15,
        y: 15,
        width: 170,
        windowWidth: 650
    });
}