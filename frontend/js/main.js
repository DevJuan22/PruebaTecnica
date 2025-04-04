new Vue({
  el: '#app',
  data: {
    ofertas: [],
    nuevaOferta: {
      objeto: '',
      descripcion: '',
      moneda: '',
      presupuesto: '',
      actividad: '',
      fecha_inicio: '',
      fecha_cierre: '',
      estado: 'ACTIVO'
    },
    docNuevo: {
      titulo: '',
      descripcion: '',
      archivo: null
    }
  },
  mounted() {
    this.obtenerOfertas();
  },
  methods: {
    obtenerOfertas() {
      axios.get('http://localhost/config/api.php?accion=listar')
        .then(response => {
          this.ofertas = response.data;
        })
        .catch(error => {
          console.error('Error al obtener ofertas:', error);
        });
    },
    crearOferta() {
      axios.post('http://localhost/config/api.php', this.nuevaOferta, {
          headers: { 'Content-Type': 'application/json' }
        })
        .then(response => {
          alert('Oferta creada con éxito');
          this.obtenerOfertas();
          this.nuevaOferta = {
            objeto: '',
            descripcion: '',
            moneda: '',
            presupuesto: '',
            actividad: '',
            fecha_inicio: '',
            fecha_cierre: '',
            estado: 'ACTIVO'
          };
        })
        .catch(error => {
          console.error('Error al crear oferta:', error);
        });
    },
    subirDocumento(ofertaId) {
      if (!this.docNuevo.archivo) {
        alert("Por favor, seleccione un archivo antes de subir.");
        return;
      }

      const formData = new FormData();
      formData.append('oferta_id', ofertaId);
      formData.append('titulo', this.docNuevo.titulo);
      formData.append('descripcion', this.docNuevo.descripcion);
      formData.append('archivo', this.docNuevo.archivo);

      axios.post('http://localhost/config/api_documentos.php', formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
      })
      .then(response => {
          alert(response.data.message);
          this.docNuevo = { titulo: '', descripcion: '', archivo: null };
      })
      .catch(error => {
          console.error('Error al subir documento:', error);
      });
    },
    publicarOferta(oferta) {
      const ahora = new Date();
      const fechaInicio = new Date(oferta.fecha_inicio);

      if (ahora >= fechaInicio) {
        const datosActualizados = {
          objeto: oferta.objeto,
          descripcion: oferta.descripcion,
          moneda: oferta.moneda,
          presupuesto: oferta.presupuesto,
          actividad: oferta.actividad,
          fecha_inicio: oferta.fecha_inicio,
          fecha_cierre: oferta.fecha_cierre,
          estado: 'PUBLICADO'
        };

        axios.put(`http://localhost/config/api.php?id=${oferta.id}`, datosActualizados, {
          headers: { 'Content-Type': 'application/json' }
        })
        .then(response => {
          alert('Oferta publicada');
          this.obtenerOfertas();
        })
        .catch(error => {
          console.error('Error al publicar la oferta:', error);
        });
      } else {
        alert('No se puede publicar antes de la fecha de inicio');
      }
    },
    exportarExcel(ofertaId) {
      window.location.href = `http://localhost/config/exportar_excel.php?id=${ofertaId}`;
    }
  }
});
