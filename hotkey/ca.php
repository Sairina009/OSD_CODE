<script src="keyboard.min.js"></script>
<script>
        keyboardJS.setContext('index');
        var currentPort = 1;
        function handleArrowKeys(e) {
            if (e.key === 'ArrowUp') {
                console.log('Arrow Up pressed!');
                currentPort = Math.min(currentPort + 1, 32); 
                console.log('Switch to Port ' + currentPort);
              window.location.href = 'port' + currentPort + '.php';

            } else if (e.key === 'ArrowDown') {
                console.log('Arrow Down pressed!');
                currentPort = Math.max(currentPort - 1, 1); 
                console.log('Switch to Port ' + currentPort);
                window.location.href = 'port' + currentPort + '.php';

            }
        }
        document.addEventListener('keydown', function(e) {
            handleArrowKeys(e);
        });
    </script>