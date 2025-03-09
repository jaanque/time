document.addEventListener('DOMContentLoaded', function() {
    // Funcionalidad para copiar código al portapapeles
    const copyButton = document.getElementById('copyCode');
    if (copyButton) {
        copyButton.addEventListener('click', function() {
            const code = this.getAttribute('data-code');
            navigator.clipboard.writeText(code).then(function() {
                // Cambiar texto del botón temporalmente
                const originalText = copyButton.innerText;
                copyButton.innerText = '¡Copiado!';
                
                setTimeout(function() {
                    copyButton.innerText = originalText;
                }, 2000);
            })
            .catch(function(err) {
                console.error('Error al copiar: ', err);
            });
        });
    }
    
    // Autoenfoque en campos de entrada cuando corresponda
    const codeInput = document.querySelector('input[name="code"]');
    if (codeInput && window.location.pathname.includes('index.php')) {
        codeInput.focus();
    }
    
    // Formatear inputs de código para que sean mayúsculas
    const codeInputs = document.querySelectorAll('input[pattern*="[A-Z0-9]"]');
    codeInputs.forEach(function(input) {
        input.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    });
    
    // Prevenir múltiples envíos de formulario
    const forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function() {
            // Deshabilitar el botón de envío
            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = 'Procesando...';
            }
        });
    });
    
    // Mostrar nombre de archivo seleccionado
    const fileInput = document.getElementById('attachment');
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'Ningún archivo seleccionado';
            const fileLabel = document.createElement('span');
            fileLabel.className = 'selected-file';
            fileLabel.textContent = 'Archivo seleccionado: ' + fileName;
            
            // Eliminar mensaje anterior si existe
            const previousLabel = this.parentNode.querySelector('.selected-file');
            if (previousLabel) {
                previousLabel.remove();
            }
            
            this.parentNode.appendChild(fileLabel);
        });
    }
    
    // Confirmación antes de salir de la página de mensaje
    const messageContainer = document.querySelector('.message-container:not(.not-found)');
    if (messageContainer && !document.querySelector('.form-container')) {
        window.addEventListener('beforeunload', function(e) {
            const message = 'Este mensaje se eliminará permanentemente si sales de esta página.';
            e.returnValue = message;
            return message;
        });
    }
});