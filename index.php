<?php include('layouts/header.php'); ?>

<div class="container mt-5">
    <div class="card shadow p-4">
        <h1 class="text-center mb-4">Descubra seu Signo</h1>
        
        <form id="signo-form" method="POST" action="show_zodiac_sign.php">
            <div class="mb-3">
                <label for="data_nascimento" class="form-label">Informe sua data de nascimento:</label>
                <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" required>
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Consultar Signo</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>