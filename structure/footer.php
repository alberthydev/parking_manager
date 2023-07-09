        <footer>
            <p id="footer"></p>
        </footer>
        <script type="text/javascript">
            const footer = document.querySelector('#footer');
            let year = new  Date().getFullYear();
            footer.textContent = "Copyright © "+year+" Albert Marques";
        </script>
    </body>
</html>