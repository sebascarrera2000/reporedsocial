const express = require("express");
const app = express();
const morgan = require("morgan");

const followController = require("./src/controller/followController");

app.use(morgan("dev"));
app.use(express.json());


// Rutas para el controlador de mensajes
app.use(followController);

app.listen(3003, () => {
  console.log("Puerto 3003 ejecutando el microservicio de follow 🫂 ");
});
