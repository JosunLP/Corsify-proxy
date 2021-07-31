class ConfigMapLoader {

    async main() {
        while (true) {
            await this.wait(500000);
            this.request("pageList");
            this.request("pluginList");
            await this.wait(500000);
        }
    }

    wait(time:number) {
        return new Promise(resolve => {
            setTimeout(() => {
                resolve();
            }, time);
        });
    }

    request(command:string) {
        $.post('/API.php?apiMode=service', {svmode: command}, function (data) {
            console.log('Event: ' + data);
        })
    }
}

let c = new ConfigMapLoader();

c.main();