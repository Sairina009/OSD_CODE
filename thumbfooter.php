</body></html>
<script type="text/javascript">
    var keyb = "user_selectionb"
    var lastSelection;
    function storeSelectionb(el) {
        window.localStorage.setItem(keyb, el.id);
    }
        function init() {
        var last = window.localStorage.getItem(keyb);
        if (last) {
            document.getElementById(last).checked = true;
        }
    }
    init();
</script>