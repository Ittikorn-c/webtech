$('#event-pdf').click(function () {
    var pdf = new jsPDF('l', 'pt', 'legal');
    source = $('#event-table')[0];
    specialElementHandlers = {
        '#bypassme': function (element, renderer) {
            return true
        }
    };
    margins = {
        top: 20,
        bottom: 20,
        left: 20,
        width: 522
    };
    pdf.fromHTML(
        source, 
        margins.left, 
        margins.top, { 
            'width': margins.width, 
            'elementHandlers': specialElementHandlers
        },

        function (dispose) {
            pdf.save('Test.pdf');
        }, margins);
});
