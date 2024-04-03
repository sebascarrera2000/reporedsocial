const mysql = require("mysql2/promise");
const connection = mysql.createPool({
  host: "localhost",
  user: "root",
  password: "",
  database: "redsocial",
});

async function obtenerMensajes() {
  const result = await connection.query("SELECT * FROM Mensajes");
  return result[0];
}

async function obtenerMensajesUsuario(usuarioId) {
  const result = await connection.query(
    "SELECT * FROM Mensajes WHERE usuario_id = ?",
    usuarioId
  );
  return result[0];
}

async function crearMensaje(usuarioId, contenido) {
  const result = await connection.query(
    "INSERT INTO Mensajes (usuario_id, contenido) VALUES (?, ?)",
    [usuarioId, contenido]
  );
  return result;
}

module.exports = {
  obtenerMensajes,
  obtenerMensajesUsuario,
  crearMensaje,
};
