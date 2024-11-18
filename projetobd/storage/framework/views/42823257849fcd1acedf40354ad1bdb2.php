

<?php $__env->startSection('content'); ?>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        background: radial-gradient(circle at 50% 50%, #000, #001022);
        color: #fff;
    }

    .container {
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        max-width: 700px;
        margin: 50px auto;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #fff;
    }

    .form-control, .form-select {
        background-color: rgba(255, 255, 255, 0.2);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 15px;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        background-color: rgba(255, 255, 255, 0.3);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    option {
        background-color: rgba(0, 0, 0, 0.8); 
        color: #fff;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        margin-right: 10px;
    }

    .btn-secondary {
        background-color: #6c757d;
    }

    .btn:hover {
        background-color: #138496;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    #other_category_group {
        display: none;
        margin-top: 15px;
    }
</style>

<div class="container">
    <h1>Create New Artist</h1>
    <form action="<?php echo e(route('artists.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="biography" class="form-label">Biography</label>
            <textarea class="form-control" id="biography" name="biography" required><?php echo e(old('biography')); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="nationality" class="form-label">Nacionalidade</label>
            <select class="form-select" id="nationality" name="nationality" required>
                <option value="" disabled selected>Selecione a Nacionalidade</option>
                <!-- As opções serão preenchidas automaticamente via JavaScript -->
            </select>
        </div>

        <div class="mb-3">
            <label for="artist_category" class="form-label">Categoria do Artista</label>
            <select class="form-select" id="artist_category" name="artist_category" required onchange="toggleOtherCategory(this.value)">
                <option value="Pintor(a)">Pintor(a)</option>
                <option value="Escultor(a)">Escultor(a)</option>
                <option value="Fotógrafo(a)">Fotógrafo(a)</option>
                <option value="Artista Digital">Artista Digital</option>
                <option value="Ilustrador(a)">Ilustrador(a)</option>
                <option value="Designer Gráfico(a)">Designer Gráfico(a)</option>
                <option value="Outro(a)">Outro(a)</option>
            </select>
        </div>

        <div id="other_category_group">
            <label for="other_category" class="form-label">Especifique a Categoria do Artista</label>
            <input type="text" class="form-control" id="other_category" name="other_category">
        </div>

        <div class="btn-wrapper">
            <button type="submit" class="btn">Salvar</button>
            <a href="<?php echo e(route('artists.index')); ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('https://restcountries.com/v3.1/all')
            .then(response => response.json())
            .then(data => {
                const nationalitySelect = document.getElementById('nationality');
                
                const nationalities = data.map(country => {
                    if (country.demonyms && country.demonyms.eng) {
                        const nationalityPT = getPortugueseNationality(country.demonyms.eng.m);
                        return {
                            value: country.demonyms.eng.m,
                            text: nationalityPT
                        };
                    }
                }).filter(n => n);

                const uniqueNationalities = Array.from(new Set(nationalities.map(n => n.text)))
                    .map(uniqueText => nationalities.find(n => n.text === uniqueText));

                uniqueNationalities.sort((a, b) => a.text.localeCompare(b.text, 'pt-BR'));

                uniqueNationalities.forEach(nationality => {
                    const option = document.createElement('option');
                    option.value = nationality.value;
                    option.textContent = nationality.text;

                    nationalitySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Erro ao buscar dados da API RestCountries:', error));

        // Função que converte a nacionalidade para o português
        function getPortugueseNationality(nationality) {
            const translationMap = {
                "Afghan": "Afegão(ã)",
                "Albanian": "Albanês(a)",
                "Algerian": "Argelino(a)",
                "American": "Americano(a)",
                "Andorran": "Andorrano(a)",
                "Angolan": "Angolano(a)",
                "Argentinian": "Argentino(a)",
                "Australian": "Australiano(a)",
                "Austrian": "Austríaco(a)",
                "Belgian": "Belga",
                "Brazilian": "Brasileiro(a)",
                "British": "Britânico(a)",
                "Canadian": "Canadense",
                "Chilean": "Chileno(a)",
                "Chinese": "Chinês(a)",
                "Colombian": "Colombiano(a)",
                "Cuban": "Cubano(a)",
                "Danish": "Dinamarquês(a)",
                "Dutch": "Holandês(a)",
                "Egyptian": "Egípcio(a)",
                "Finnish": "Finlandês(a)",
                "French": "Francês(a)",
                "German": "Alemão(ã)",
                "Indian": "Indiano(a)",
                "Italian": "Italiano(a)",
                "Japanese": "Japonês(a)",
                "Mexican": "Mexicano(a)",
                "Russian": "Russo(a)",
                "Spanish": "Espanhol(a)",
                "Swedish": "Sueco(a)",
                "Swiss": "Suíço(a)",
                "South African": "Sul-africano(a)",
                "Turkish": "Turco(a)",
                "Venezuelan": "Venezuelano(a)"
            };
            return translationMap[nationality] || nationality;
        }
    });

    function toggleOtherCategory(value) {
        const otherCategoryGroup = document.getElementById('other_category_group');
        if (value === 'Outro(a)') {
            otherCategoryGroup.style.display = 'block';
        } else {
            otherCategoryGroup.style.display = 'none';
            document.getElementById('other_category').value = '';
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\projetobd\resources\views/artists/create.blade.php ENDPATH**/ ?>