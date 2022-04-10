<template>
    <section class="jumbotron overflow-hidden bg-primary">
        <div class="container-fluid">
            <div class="row flex-center">
                <div class="col-md-6 col-lg-6 pt-5 pt-md-0 text-md-start text-center d-flex flex-column justify-content-center">
                    <div id="container" class="row row-cols-1 row-cols-xl-2 align-items-center">
                        <div class="col col-xl-8">
                            <h1 class="text-light pe-0 m-0">oggi ho voglia di</h1>
                        </div>
                        <div id=flip class="col col-xl-4 ps-0">
                            <div>
                                <div>pizza</div>
                            </div>
                            <div>
                                <div>poke</div>
                            </div>
                            <div>
                                <div>sushi</div>
                            </div>
                            <div>
                                <div>carne</div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 px-0 img-container">
                    <img class="img-fluid" src="../../img/jumbotron.png" alt="hero-header">
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "Jumbotron",
}
</script>

<style lang="scss" scoped>
.jumbotron {
    height: 400px;
    // margin-top: 60px;

    h1.text-light{
        font-weight: 700;
        color: #F9FAFD !important;
    }

    .img-container {
        height: 400px;
        padding-top: 7rem;

        img {
            width: 700px;
        }
    }
}

span:before {
	content: 'TRANSITIONS';
	text-transform: uppercase;
	color: #1B1464;
	animation: word-switch 10s infinite;
    }

    @keyframes word-switch {
	0% { content: 'Pizza' }
	20% { content: 'Cinese' }
	40% { content: 'Hamburger' }
	60% { content: 'Sushi' }
	80% { content: 'Indiano' }
	100% { content: 'Pizza' }
    }

@media (max-width: 767.98px){
    .jumbotron {
        // height: 400px;
        // margin-top: 60px;

        // h1.text-light{
        //     font-weight: 700;
        //     color: #F9FAFD !important;
        // }
        text-align: center;

        .img-container {
            // height: 400px;
            padding-top: 4.6rem;
            text-align: center;

            img {
                width: 450px;
            }
        }
        #flip {
            text-align: center;
        }

    }
}

@media(min-width: 767.98px) and (max-width: 1200px){
    h1 {
        text-align: end;
    }

    #flip {
        text-align: end;
    }
}

@media(min-width: 767.98px) and (max-width: 991.98px){
    .jumbotron .img-container {
        padding-top: 9.5rem;
    }
}

@media (min-width: 1200px){
    #flip {
        text-align: start;
    }

    h1 {
        text-align: end;
    }
}

.py-8 {
    padding-top: 7.5rem !important;
    padding-bottom: 7.5rem !important;
}


.text-800 {
    color: white !important;
    font-weight: 400;
}


.fs-4 {
    font-size: 2.0736rem !important;
}

.bg-primary {
    background: linear-gradient(315deg, hsla(348, 57%, 52%, 1) 0%, hsla(33, 94%, 57%, 1) 76%);
    // background: linear-gradient(315deg, #ca3f5b 0%, #e97640 52%);
    // background: linear-gradient(315deg, hsla(348, 57%, 52%, 1) 0%, hsla(33, 68%, 68%, 1) 51%);
}

.fs-md-5 {
    font-size: 2.48832rem;
}

#container {
  color:#999;
  text-transform: uppercase;
  font-size:36px;
  font-weight:bold;
//   padding-top:200px;  
//   position:fixed;
//   width:100%;
//   bottom:45%;
}

#flip {
  height:53px;
  overflow:hidden;
  display: flex;
  flex-direction: column;

}

#flip > div > div {
  color: #01678F;
//   padding:4px 12px;
  height:45px;
  margin-bottom:45px;
  display:inline-block;

//   &::after {
//       content: '?';
//       color: white;
//   }
}

#flip div:first-child {
  animation: show 6s linear infinite;
}

// #flip div div {
//   background:#42c58a;
// }
// #flip div:first-child div {
//   background:#4ec7f3;
// }
// #flip div:last-child div {
//   background:#DC143C;
// }

@keyframes show {

    0% {margin-top:-360px;}
    5% {margin-top:-270px}
    23.75% {margin-top:-270px}
    28.75% {margin-top:-180px;}
    47.5% {margin-top:-180px;}
    52.5% {margin-top:-90px;}
    71.25% {margin-top:-90px;}
    76.25% {margin-top:0px;}
    95% {margin-top: 0px;}
    99.99% {margin-top:50px;}
    100% {margin-top:-360px;}



}

p {
  position:fixed;
  width:100%;
  bottom:30px;
  font-size:12px;
  color:#999;
  margin-top:200px;
}
</style>