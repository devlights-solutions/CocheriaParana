namespace Cocheria
{
    partial class Form1
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.label1 = new System.Windows.Forms.Label();
            this.TxtSepelios = new System.Windows.Forms.TextBox();
            this.BtnVerSepelios = new System.Windows.Forms.Button();
            this.BtnCrearSepelio = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(62, 58);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(140, 17);
            this.label1.TabIndex = 0;
            this.label1.Text = "Cantidad de sepelios";
            // 
            // TxtSepelios
            // 
            this.TxtSepelios.Location = new System.Drawing.Point(251, 55);
            this.TxtSepelios.Name = "TxtSepelios";
            this.TxtSepelios.Size = new System.Drawing.Size(546, 22);
            this.TxtSepelios.TabIndex = 1;
            // 
            // BtnVerSepelios
            // 
            this.BtnVerSepelios.Location = new System.Drawing.Point(265, 92);
            this.BtnVerSepelios.Name = "BtnVerSepelios";
            this.BtnVerSepelios.Size = new System.Drawing.Size(125, 120);
            this.BtnVerSepelios.TabIndex = 2;
            this.BtnVerSepelios.Text = "Ver sepelios";
            this.BtnVerSepelios.UseVisualStyleBackColor = true;
            this.BtnVerSepelios.Click += new System.EventHandler(this.BtnVerSepelios_Click);
            // 
            // BtnCrearSepelio
            // 
            this.BtnCrearSepelio.Location = new System.Drawing.Point(430, 103);
            this.BtnCrearSepelio.Name = "BtnCrearSepelio";
            this.BtnCrearSepelio.Size = new System.Drawing.Size(159, 109);
            this.BtnCrearSepelio.TabIndex = 3;
            this.BtnCrearSepelio.Text = "Crear Sepelio";
            this.BtnCrearSepelio.UseVisualStyleBackColor = true;
            this.BtnCrearSepelio.Click += new System.EventHandler(this.BtnCrearSepelio_Click);
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(938, 566);
            this.Controls.Add(this.BtnCrearSepelio);
            this.Controls.Add(this.BtnVerSepelios);
            this.Controls.Add(this.TxtSepelios);
            this.Controls.Add(this.label1);
            this.Name = "Form1";
            this.Text = "Form1";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.TextBox TxtSepelios;
        private System.Windows.Forms.Button BtnVerSepelios;
        private System.Windows.Forms.Button BtnCrearSepelio;
    }
}

