var CoomingSoon = function () {    return {        init: function () {            $.backstretch([    		        "assets/img/1.jpg",    		        "assets/img/2.jpg",    		        "assets/img/3.jpg",    		        "assets/img/4.jpg"    		        ], {    		          fade: 1000,    		          duration: 10000    		    });            var austDay = new Date();            austDay = new Date(austDay.getFullYear() + 1, 1 - 1, 26);            $('#defaultCountdown').countdown({until: austDay});            $('#year').text(austDay.getFullYear());        }    };}();