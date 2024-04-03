const express = require("express");
const app = express();
const morgan = require("morgan");

const mensajesController = require("./src/controller/mensajesController");

app.use(morgan("dev"));
app.use(express.json());


// Rutas para el controlador de mensajes
app.use(mensajesController);

app.listen(3002, () => {
  console.log("Puerto 3002 ejecutando el microservicio de mesnajes 📧");
});
