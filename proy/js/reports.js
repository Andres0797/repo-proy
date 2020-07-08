// Our labels and three data series


async function nuevaData(){
  try {
    var resultado = await fetch('http://localhost/contador/ruta/1');
    var resjson = await resultado.json();  
    return resjson;
  } catch (error) {
    return;
  }
}

var data = {

    labels: ['10:00', '11:00', '12:00', '13:00', '14:00', '15:00'],
    series: [
      [50, 40, 30, 70, 5, 10]
    ]
  };

  // We are setting a few options for our chart and override the defaults
  var options = {
    // Don't draw the line chart points
    showPoint: true,
    // Disable line smoothing
    lineSmooth: false,
    // X-Axis specific configuration
    axisX: {
      // We can disable the grid for this axis
      showGrid: false,
      // and also don't show the label
      showLabel: true
    },
    // Y-Axis specific configuration
    axisY: {
      // Lets offset the chart a bit from the labels
      offset: 60,
      // The label interpolation function enables you to modify the values
      // used for the labels on each axis. Here we are converting the
      // values into million pound.
      labelInterpolationFnc: function(value) {
        return value + ' visitas';
      }
    }
  };
  
  // All you need to do is pass your configuration as third parameter to the chart function
  new Chartist.Line('.ct-chart', data, options);