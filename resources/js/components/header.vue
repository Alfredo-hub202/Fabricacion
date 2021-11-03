
<template>
    <div>
        <h1>Hola</h1>
    </div>
</template>
<script>
console.log("hola")
// Creamos la instancia del objeto XHR
const client = new XMLHttpRequest();

// Preparamos la petición y la enviamos
client.open("GET", "elifexir.com/wp-json/wc/v3/orders?consumer_key=ck_678a80fbd3153ba620122bfdd169acd5bb499b7d&consumer_secret=cs_a0b57074efdeeb079122d14f8c9af38892d9277f&page=1&per_page=5");
client.send();
// Consultamos la propiedad que almacena el contenido
console.log(client.responseText);

</script>