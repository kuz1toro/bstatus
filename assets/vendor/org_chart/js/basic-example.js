var config = {
        container: "#basic-example",

        connectors: {
            type: 'step'
        },
        node: {
            HTMLclass: 'nodeExample1'
        }
    },
    ceo = {
        text: {
            name: "Jon Vendri, S.Si, M.M.",
            title: "Kepala Bidang Pencegahan",
        },
        image: base_url+'assets/vendor/org_chart/headshots/nouserlogo.gif'
    },

    cto = {
        parent: ceo,
        text:{
            name: "Suheri, S.Sos, M.AP.",
            title: "Kepala Seksi Bina Teknis",
        },
        stackChildren: true,
        image: base_url+'assets/vendor/org_chart/headshots/nouserlogo.gif'
    },
    cbo = {
        parent: ceo,
        HTMLclass: 'nodeLarge',
        stackChildren: true,
        text:{
            name: "Deni Andreas, S.Kom, M.KKK.",
            title: "Kepala Seksi Inspeksi",
        },
        image: base_url+'assets/vendor/org_chart/headshots/nouserlogo.gif'
    },
    cdo = {
        parent: ceo,
        stackChildren: true,
        text:{
            name: "Eko Budianto, S.Kom.",
            title: "Kepala Seksi Penindakan",
        },
        image: base_url+'assets/vendor/org_chart/headshots/nouserlogo.gif'
    },
    cio = {
        parent: cto,
        text:{
            name: "Udiyono",
            title: "Komandan Regu I"
        },
        image: base_url+'assets/vendor/org_chart/headshots/nouserlogo.gif'
    },
    cio3 = {
        parent: cto,
        text:{
            name: "Miyanto, S.E.",
            title: "Komandan Regu IV"
        },
        image: base_url+'assets/vendor/org_chart/headshots/nouserlogo.gif'
    },
    cio2 = {
        parent: cbo,
        text:{
            name: "Suparman",
            title: "Komandan Regu V"
        },
        image: base_url+'assets/vendor/org_chart/headshots/nouserlogo.gif'
    },
    ciso2 = {
        parent: cdo,
        text:{
            name: "Sidik, S.T.",
            title: "Komandan Regu III"
        },
        image: base_url+'assets/vendor/org_chart/headshots/nouserlogo.gif'
    },
    ciso3 = {
        parent: cbo,
        HTMLclass: 'nodeLarge',
        text:{
            name: "Bambang Andanawari, S.ST.",
            title: "Komandan Regu II"
        },
        image: base_url+'assets/vendor/org_chart/headshots/nouserlogo.gif'
    }

    chart_config = [
        config,
        ceo,
        cto,
        cbo,
        cdo,
        cio,
        cio2,
        cio3,
        ciso2,
        ciso3
    ];




    // Antoher approach, same result
    // JSON approach

/*
    var chart_config = {
        chart: {
            container: "#basic-example",

            connectors: {
                type: 'step'
            },
            node: {
                HTMLclass: 'nodeExample1'
            }
        },
        nodeStructure: {
            text: {
                name: "Mark Hill",
                title: "Chief executive officer",
                contact: "Tel: 01 213 123 134",
            },
            image: "../headshots/2.jpg",
            children: [
                {
                    text:{
                        name: "Joe Linux",
                        title: "Chief Technology Officer",
                    },
                    stackChildren: true,
                    image: "../headshots/1.jpg",
                    children: [
                        {
                            text:{
                                name: "Ron Blomquist",
                                title: "Chief Information Security Officer"
                            },
                            image: "../headshots/8.jpg"
                        },
                        {
                            text:{
                                name: "Michael Rubin",
                                title: "Chief Innovation Officer",
                                contact: "we@aregreat.com"
                            },
                            image: "../headshots/9.jpg"
                        }
                    ]
                },
                {
                    stackChildren: true,
                    text:{
                        name: "Linda May",
                        title: "Chief Business Officer",
                    },
                    image: "../headshots/5.jpg",
                    children: [
                        {
                            text:{
                                name: "Alice Lopez",
                                title: "Chief Communications Officer"
                            },
                            image: "../headshots/7.jpg"
                        },
                        {
                            text:{
                                name: "Mary Johnson",
                                title: "Chief Brand Officer"
                            },
                            image: "../headshots/4.jpg"
                        },
                        {
                            text:{
                                name: "Kirk Douglas",
                                title: "Chief Business Development Officer"
                            },
                            image: "../headshots/11.jpg"
                        }
                    ]
                },
                {
                    text:{
                        name: "John Green",
                        title: "Chief accounting officer",
                        contact: "Tel: 01 213 123 134",
                    },
                    image: "../headshots/6.jpg",
                    children: [
                        {
                            text:{
                                name: "Erica Reel",
                                title: "Chief Customer Officer"
                            },
                            link: {
                                href: "http://www.google.com"
                            },
                            image: "../headshots/10.jpg"
                        }
                    ]
                }
            ]
        }
    };

*/
