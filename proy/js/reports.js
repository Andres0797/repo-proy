

  const res = {
  uno: null, 
  L10: null,
  // M86 : null
  }
  fetch('http://localhost/contador/ruta/1')
  .then(function(datos){
    return datos.json();
  })
  .then(function(datos){
    res.uno = datos; 
  })
  .then(function(){
    return fetch('http://localhost/contador/ruta/3')
  })
  .then(function(datos){
    return datos.json();
  })
  .then(function(datos){
    res.L10 = datos;  
  })
  // .then(function(){
  //   return fetch('http://localhost/contador/ruta/:idRuta')
  // })
  // .then(function(datos){
  //   return datos.json();
  // })
  // .then(function(datos){
  //   res.M86 = datos;  
  // })
  .then(function(){
    document.getElementById("loading").style.opacity =  0;
    const options = {
      showPoint: true,
      lineSmooth: Chartist.Interpolation.cardinal({
        tension: 0.2
      }),
      axisX: {
        showGrid: true,
        showLabel: true,
        labelInterpolationFnc: function(value) {
          return value + ':00AM';
        }
      },
      axisY: {
        offset: 60,
      }
    };
    const dataC = {
      labels: Object.keys(res.L10),
      series: [Object.values(res.uno),Object.values(res.L10)]
    //series: [Object.values(res.uno),Object.values(res.L10),Object.values(res.M86)]
    };
    new Chartist.Line('.ct-chart', dataC, options);
  })
  