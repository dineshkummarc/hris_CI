</div>
</section>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="<?= base_url('assets/') ?>js/popper.min.js"></script>
<script src="<?= base_url('assets/') ?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets/') ?>js/main.js"></script>
<script>
    function change() {
        var x = document.getElementById('password').type;
        if (x == 'password') {
            document.getElementById('password').type = 'text';
            document.getElementById('mybutton').innerHTML = `<span id="mybutton" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>`;
        } else {
            document.getElementById('password').type = 'password';
            document.getElementById('mybutton').innerHTML = `<span id="mybutton" onclick="change()" class="fa fa-fw fa-eye field-icon toggle-password"></span>`;
        }
    }
</script>
</body>

</html>