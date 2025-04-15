<div class="relative w-full max-w-md mx-auto mb-8">
    <div class="flex bg-gray-200 rounded-2xl relative overflow-hidden">

        <!-- Slider Azul -->
        <div
            id="slider"
            class="absolute top-0 left-0 w-1/2 h-full bg-blue-900 rounded-2xl transition-all duration-300 z-0"
        ></div>

        <!-- Botões -->
        <button
            id="btn-comprar"
            class="w-1/2 text-center z-10 cursor-pointer py-3 px-6 text-xl font-medium text-white"
        >
            Comprar
        </button>
        <button
            id="btn-arrendar"
            class="w-1/2 text-center z-10 cursor-pointer py-3 px-6 text-xl font-medium text-gray-800"
        >
            Arrendar
        </button>
    </div>
</div>

<script>
    const btnComprar = document.getElementById("btn-comprar");
    const btnArrendar = document.getElementById("btn-arrendar");
    const slider = document.getElementById("slider");

    btnComprar.addEventListener("click", () => {
        slider.style.left = "0%";
        btnComprar.classList.add("text-white", "font-semibold");
        btnArrendar.classList.remove("text-white", "font-semibold");
        btnArrendar.classList.add("text-gray-800");
    });

    btnArrendar.addEventListener("click", () => {
        slider.style.left = "50%";
        btnArrendar.classList.add("text-white", "font-semibold");
        btnComprar.classList.remove("text-white", "font-semibold");
        btnComprar.classList.add("text-gray-800");
    });
</script>
