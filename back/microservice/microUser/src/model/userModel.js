const mysql = require("mysql2/promise");
const connection = mysql.createPool({
  host: "localhost",
  user: "root",
  password: "",
  database: "redsocial",
});

async function traerUsuarios() {
  const result = await connection.query("SELECT * FROM Usuarios");
  return result[0];
}

async function traerUsuario(usuario) {
  const result = await connection.query(
    "SELECT * FROM Usuarios WHERE usuario = ? ",
    usuario
  );
  return result[0];
}


async function traerUsuarioId(id) {
  const result = await connection.query(
    "SELECT * FROM Usuarios WHERE Id = ? ",
   id
  );
  return result[0];
}
async function validarUsuario(usuario, password) {
  const result = await connection.query(
    "SELECT * FROM Usuarios WHERE usuario = ? AND password = ?",
    [usuario, password]
  );
  return result[0];
}

async function crearUsuario(nombre_completo, usuario, password, rol) {
  const result = await connection.query(
    "INSERT INTO Usuarios (nombre_completo, usuario, password, rol) VALUES (?, ?, ?, ?)",
    [nombre_completo, usuario, password, rol]
  );
  return result;
}



module.exports = {
  traerUsuario,
  traerUsuarios,
  validarUsuario,
  crearUsuario,
  traerUsuarioId,

};
