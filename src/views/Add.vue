<template>
    <b-container full class="add">
        <b-row>
            <b-col cols="12">
                <h1>Neues Bild</h1>
                <b-form-select ref="videoSelect" v-model="selected" :options="options" class="mb-3" @change="selectionChanged"/>

                <video ref="video" @click="onVideoClicked" autoplay></video>
                <img ref="image" alt="" style="width:100%"></img>
                <canvas ref="canvas" style="display:none"></canvas>
                <hr>
                <b-form-input v-model="title" placeholder="Iitel"></b-form-input>
                <b-form-textarea v-model="text" :rows="4" placeholder="Informationstext"></b-form-textarea>
                <b-button @click="sendImage">Absenden</b-button>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>

    import axios from 'axios';

    export default {
        name: 'addView',
        components: {},
        stream:null,
        data() {
            return {
                selected: 'none',
                options: [],
                text:'',
                title:''
            }
        },
        mounted() {
            const videoSelect = this.$refs.videoSelect;
            let options = [{text:'Kamera Auswählen',value:'none',}];
            navigator.mediaDevices.enumerateDevices()
                .then((deviceInfos) => {
                    for (const deviceInfo of deviceInfos) {
                        if (deviceInfo.kind === 'videoinput') {
                            options.push({
                                text:deviceInfo.label || 'camera ' +
                                    (options.length),
                                value:deviceInfo.deviceId
                            })
                        } else {
                            console.log('Found one other kind of source/device: ', deviceInfo);
                        }
                    }
                    this.options = options;
                    if (navigator.userAgent.match(/Win64/)){
                        let tmpImg = new Image();
                        let image = this.$refs.image;
                        let canvas = this.$refs.canvas;
                        tmpImg.onload = ()=> {
                            canvas.width = tmpImg.naturalWidth;
                            canvas.height = tmpImg.naturalHeight;
                            canvas.getContext('2d').drawImage(tmpImg, 0, 0);
                            // Other browsers will fall back to ima+ge/png
                            image.src = canvas.toDataURL('image/jpg');
                        }
                        tmpImg.src = '/images/test.jpg';
                    }
                }).catch((error) => {
                console.log('enumerateDeviceError', error)
            });

        },
        methods: {
            clearStream() {
                if (this.stream) {
                    this.stream.getTracks().forEach((track) => {
                        track.stop();
                    });
                }
            },
            selectionChanged() {
                this.clearStream();
                const constraints = {
                    video: {
                        deviceId: {exact: this.selected},
                        width: {exact: 1024},
                        height: {exact: 768}
                    }
                };

                navigator.mediaDevices.getUserMedia(constraints).then((stream)=>{
                    this.stream = stream; // make stream available to console
                    this.$refs.video.srcObject = stream;
                }).catch((error)=>{
                    console.log('getUserMediaError', error)
                });
            },
            onVideoClicked() {
                const image = this.$refs.image;
                const canvas = this.$refs.canvas;
                const videoElement = this.$refs.video;
                if(this.stream){
                    canvas.width = videoElement.videoWidth;
                    canvas.height = videoElement.videoHeight;
                    canvas.getContext('2d').drawImage(videoElement, 0, 0);
                    // Other browsers will fall back to ima+ge/png
                    image.src = canvas.toDataURL('image/jpg');
                }
            },
            sendImage() {
                const image = this.$refs.image;
                const canvas = this.$refs.canvas;
                console.log('canvas', canvas);
                const dataUrl = canvas.toDataURL('image/jpg');
                axios.post('/api/image/add', {
                    title:this.title,
                    info:this.info,
                    image:dataUrl
                })

            }
        }

    }
</script>
<style>
    video {
        width: 100%;
        border: 1px solid red;
    }
</style>

