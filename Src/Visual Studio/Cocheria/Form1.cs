using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Cocheria
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void BtnVerSepelios_Click(object sender, EventArgs e)
        {
            //cocheria.webserv CallWebService = new cocheria.webserv();
            cocheriaTest.webserv CallWebService = new cocheriaTest.webserv();
            String sGetValue = CallWebService.ConsultaSepelios();
            TxtSepelios.Text = sGetValue;
        }

        private void BtnCrearSepelio_Click(object sender, EventArgs e)
        {
            cocheriaTest.webserv CrearSepelio = new cocheriaTest.webserv();
            string _crearSepelio = CrearSepelio.CrearSepelio(
                //Nombre//
                "Sepelio  de prueba Posadas",
                //Fecha Fallecimiento
                DateTime.Now,
                //Fecha Sepelio
                DateTime.Now,
                //Hora Inhumacion
                "20:00", 
                //Id Localidad
                "3483", 
                //Nombre Localidad.
                "Posadas",
                //Otro Cementerio.
                "Test ñÑa", 
                //Id Sala
                55558,
                //Nombre Sala
                "Test",
                //Fecha Misa
                DateTime.Now,
                //Hora Misa
                "20:00",
                //iglesiaId
                55558, 
                //Nombre de Iglesia
                "Test",
                //Otro Lugar de misa
                "",
                //Lugar Inhumacion
                55558,
                //Nombre Lugar Inhumacion
                "Test", 
                //Fecha de Nacimiento
                DateTime.Now,
                //Opcion Inhumacion Cremacion 
                1, 
                //Lugar Cremacion
                55558, 
                //Nombre Lugar Cremacion
                "Test",
                //Nombre Otra sala
                "Test",
                //Domicilio Otra Sala
                "Test", 
                //Id Oracion
                55558, 
                //Nombre Oracion
                "Test", 
                //Contenido Oracion
                "55558", 
                //Id Cocheria
                55558, 
                //Domicilio Sala
                "test");
            TxtSepelios.Text = _crearSepelio;
        }
    }
}
