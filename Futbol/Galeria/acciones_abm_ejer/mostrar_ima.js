
                              function archivo(evt) {
                                  var file = evt.target.files; // FileList object
                             
                                  // Obtenemos la imagen del campo "file".
                                  for (var i = 0, f; f = file[i]; i++) {
                                    //Solo admitimos imágenes.
                                    if (!f.type.match('image.*')) {
                                        continue;
                                    }
                             
                                    var reader = new FileReader();
                             
                                    reader.onload = (function(theFile) {
                                        return function(e) {
                                          // Insertamos la imagen
                          document.getElementById("mostrar-ima").innerHTML = ['<img class="img-rounded" src="', e.target.result,'" title="', escape(theFile.name), '" width="200" heigth="200" />'].join('');
                                        };
                                    })(f);
                             
                                    reader.readAsDataURL(f);
                                  }
                              }
                             
                              document.getElementById('abrir-ima').addEventListener('change', archivo, false);
