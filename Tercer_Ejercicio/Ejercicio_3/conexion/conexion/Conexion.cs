using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace conexion
{
    class Conexion
    {

        private readonly MySqlConnection conex = null;
        private readonly MySqlConnectionStringBuilder cadena = new MySqlConnectionStringBuilder();
        public Conexion()
        {
            MySqlConnection conexion = new MySqlConnection();
            string connectionString = "server=127.0.0.1;port=3306;database=Ejercicio3;uid=root;pwd="+"";
            conexion.ConnectionString = connectionString;
            conexion.Open();
            conex = new MySqlConnection(conexion.ConnectionString);
        }
        public MySqlConnection Conex()
        {
            return conex;
        }
    }
}
