
$('.eliminar-articulo').click(function() {
    // Obtener el ID del artículo desde el atributo de datos del botón
    var articuloId = $(this).data('articulo-id');
    console.log(articuloId);
    // Realizar la solicitud Ajax para eliminar el artículo
    $.ajax({
    url: 'eliminar_articulo.php',
    method: 'POST',
    data: { articuloId: articuloId },
    success: function(response) {
        // Eliminar el elemento de la interfaz gráfica (opcional)
        $(this).closest('.articulo-row').remove();
        
        // Mostrar una notificación o realizar otras acciones necesarias
        alert('El artículo ha sido eliminado exitosamente.');
    },
    error: function(xhr, status, error) {
        // Manejar los errores de la solicitud
        console.error(error);
        alert('Error al eliminar el artículo. Por favor, inténtalo de nuevo.');
    }
    });
});

