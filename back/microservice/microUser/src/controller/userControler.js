const { Router } = require("express");
const router = Router();
const usuariosModel = require("../model/userModel");

// Obtener todos los usuarios
router.get("/usuarios", async (req, res) => {
  try {
    const result = await usuariosModel.traerUsuarios();
    res.json(result);
  } catch (error) {
    console.error("Error al obtener usuarios:", error);
    res.status(500).json({ error: "Error interno del servidor" });
  }
});

// Obtener un usuario por nombre de usuario
router.get("/usuarios/:usuario", async (req, res) => {
  try {
    const usuario = req.params.usuario;
    const result = await usuariosModel.traerUsuario(usuario);
    res.json(result);
  } catch (error) {
    console.error("Error al obtener usuario:", error);
    res.status(500).json({ error: "Error interno del servidor" });
  }
});

// Obtener un usuario por id
router.get("/usuariosId/:id", async (req, res) => {
  try {
    const id = req.params.id;
    const result = await usuariosModel.traerUsuarioId(id);
    res.json(result);
  } catch (error) {
    console.error("Error al obtener usuario:", error);
    res.status(500).json({ error: "Error interno del servidor" });
  }
});



// Validar usuario por nombre de usuario y contraseña
router.get("/usuarios/:usuario/:password", async (req, res) => {
  const usuario = req.params.usuario;
  const password = req.params.password;
  var result;

  result = await usuariosModel.validarUsuario(usuario, password);
  res.json(result);
});

// Crear un nuevo usuario
router.post("/usuarios", async (req, res) => {
  try {
    const { nombre_completo, usuario, password, rol } = req.body;
    await usuariosModel.crearUsuario(nombre_completo, usuario, password, rol);
    res.status(201).json({ message: "Usuario creado correctamente" });
  } catch (error) {
    console.error("Error al crear usuario:", error);
    res.status(500).json({ error: "Error interno del servidor" });
  }
});

module.exports = router;
