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
            string _crearSepelio = CrearSepelio.CrearSepelio("Sepelio  de prueba Posadas", DateTime.Now, DateTime.Now, "20:00", "01.02.01.02", "Bella Vista",
                "Test ñÑa", 55557, "Test", DateTime.Now, "20:00", 55557, "Test", "", 55557, "Test", DateTime.Now, 1, 55557, "Test", "Test", "Test", 55557, "Test", "55557", 55557, "test");
            TxtSepelios.Text = _crearSepelio;
        }
    }
}
