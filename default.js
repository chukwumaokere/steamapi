(function () {
      
      const remote = require('electron').remote; 
      
      function init() { 
	  /*
        document.getElementById("min-btn").addEventListener("click", function (e) {
          const window = remote.getCurrentWindow();
          window.minimize(); 
        });
        
        document.getElementById("max-btn").addEventListener("click", function (e) {
          const window = remote.getCurrentWindow();
          if (!window.isMaximized()) {
            window.maximize();
          } else {
            window.unmaximize();
          }	 
        });
        */
		
		console.log(document.getElementById("close"));
        document.getElementById("close").addEventListener("click", function (e) {
          const window = remote.getCurrentWindow();
          window.close();
        }); 
      }; 
      
      document.onreadystatechange = function () {
        if (document.readyState == "complete") {
          init(); 
        }
      };
})();