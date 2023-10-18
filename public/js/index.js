function Slider(els, opts = {}) {
    var position,
        action = 0;
    return new(function() {
        this.wrap = typeof els.wrap === "string" ? document.querySelector(els.wrap) : els.wrap;
        this.list = this.wrap.querySelector("ul");
        this.wrap.style.overflow = "hidden";
        this.list.style.display = "flex";
        this.current = {
            value: 0,
        };

        this.update = (opt = {}) => {
            opts = {
                ...opts,
                ...opt,
            };
            this.infinite = opts.infinite || false;
            this.vert = opts.vert || false;
            this.auto = opts.auto || false;
            this.size = opts.size || false;
            this.flip = opts.flip || false;
            this.touch = opts.touch || false;
            this.time = opts.time || 5000;
            this.move = opts.move || 1;
            this.cols = opts.cols || 1;
            this.gap = opts.gap || 0;

            if (this.infinite) {
                [...this.list.children].map((e) => e.isCloned && e.remove());

                const len = this.list.children.length;
                const firsts = [...this.list.children].reduce((a, e, i) => {
                    if (i < this.cols) {
                        const x = e.cloneNode(true);
                        x.setAttribute("x-clone", "");
                        a.push(x);
                    }
                    return a;
                }, []);
                const lasts = [...this.list.children].reduce((a, e, i) => {
                    if (i > len - this.cols - 1) {
                        const x = e.cloneNode(true);
                        x.setAttribute("x-clone", "");
                        a.push(x);
                    }
                    return a;
                }, []);

                if (firsts.length)
                    for (let i = 0; i < this.cols; i++) {
                        const current = firsts[i];
                        this.list.insertAdjacentElement("beforeend", current);
                        current.isCloned = true;
                    }

                if (lasts.length)
                    for (let i = this.cols; i > 0; i--) {
                        const current = lasts[i - 1];
                        this.list.insertAdjacentElement("afterbegin", current);
                        current.isCloned = true;
                    }
            }

            this.items = [...this.list.children];
            this.length = this.items.length;

            this.__opt = this.vert ? {
                size: "clientHeight",
                item: "height",
                scroll: "scrollTop",
                pos: "clientY",
            } : {
                size: "clientWidth",
                item: "width",
                scroll: "scrollLeft",
                pos: "clientX",
            };

            this.size && (this.wrap.style[this.__opt.item] = this.size * this.cols + this.gap * (this.cols - 1) + "px");
            this.size && (this.wrap.style[this.__opt.its] = this.size * this.cols + this.gap * (this.cols - 1) + "px");

            this.list.style.width = "";
            this.list.style.flexDirection = "";
            this.list.style.width = "";
            this.list.style.height = "";

            this.vert ?
                (this.list.style.width = "100%") && (this.list.style.flexDirection = "column") :
                (this.list.style.width = "max-content") && (this.list.style.height = "100%");

            this.itemSize = this.wrap[this.__opt.size] / this.cols - (this.gap * (this.cols - 1)) / this.cols;
            this.scrollLength = this.itemSize + this.gap;
            this.list.style.gap = this.gap + "px";

            for (let i = 0; i < this.length; i++) {
                this.items[i].style[this.__opt.item] = this.itemSize + "px";
            }
            if (!this.__isLunched && this.current.value === 0) {
                this.current.value = this.cols * this.move;
                window.onresize = this.update;
                this.__isLunched = true;
            }

            this.wrap.style.scrollBehavior = "unset";
            this.wrap[this.__opt.scroll] = this.scrollLength * this.current.value;
            this.wrap.style.scrollBehavior = "smooth";

            this.update.__auto && this.update.__auto();
            this.update.__touch && this.update.__touch();
        };

        this.update.__auto = () => {
            if (this.auto) {
                const repeatOften = () => {
                    clearTimeout(this.__timer);
                    this.__timer = setTimeout(() => {
                        this.flip ? this.scrollPrev() : this.scrollNext();
                        requestAnimationFrame(repeatOften);
                    }, this.time);
                };
                requestAnimationFrame(repeatOften);
            }
        };

        this.update.__touch = () => {
            if (this.touch) {
                this.wrap.onpointerdown = (e) => {
                    e.preventDefault();
                    if (action == 0) {
                        action = 1;
                        position = e[this.__opt.pos];
                    }
                    this.wrap.onpointermove = (e) => {
                        e.preventDefault();
                        var fn;
                        if (e[this.__opt.pos] > position) fn = this.scrollPrev;
                        if (e[this.__opt.pos] < position) fn = this.scrollNext;
                        if (action == 1) {
                            action = 2;
                            if (fn) {
                                this.update.__auto();
                                fn();
                            }
                        }
                    };
                    this.wrap.onpointerup = (e) => {
                        e.preventDefault();
                        if (action == 2) action = 0;
                        this.wrap.onpointermove = null;
                        this.wrap.onpointerup = null;
                    };
                };
            } else this.wrap.onpointerdown = null;
        };

        this.update();

        this.scroll = () => {
            this.wrap[this.__opt.scroll] = this.scrollLength * this.current.value;
        };

        this.scrollTo = (idx) => {
            this.current.value = idx;
            this.scroll();
        }

        this.scrollNext = () => {
            if (this.current.value >= this.length - this.cols) {
                if (this.infinite) {
                    this.wrap.style.scrollBehavior = "unset";
                    this.current.value = this.cols;
                    this.scroll();
                    this.current.value += this.move;
                    this.wrap.style.scrollBehavior = "smooth";
                } else this.current.value = 0;
            } else this.current.value += this.move;
            this.scroll();
        };

        this.scrollPrev = () => {
            if (this.current.value <= 0) {
                if (this.infinite) {
                    this.wrap.style.scrollBehavior = "unset";
                    this.current.value = this.length - this.cols - this.cols;
                    this.scroll();
                    this.current.value -= this.move;
                    this.wrap.style.scrollBehavior = "smooth";
                } else this.current.value = this.length - this.cols;
            } else this.current.value -= this.move;
            this.scroll();
        };

        this.resize = (fn_true = () => {}, fn_false = () => {}, condistion = "(min-width: 1024px)") => {
            const fn = () => {
                if (window.matchMedia(condistion).matches) fn_true();
                else fn_false();
            }
            window.addEventListener("resize", fn);
            fn();
        }

        if (els.prev) {
            this.prev = typeof els.prev === "string" ? document.querySelector(els.prev) : els.prev;
            this.prev.addEventListener("click", this.scrollPrev);
        }

        if (els.next) {
            this.next = typeof els.next === "string" ? document.querySelector(els.next) : els.next;
            this.next.addEventListener("click", this.scrollNext);
        }

        this.update.__auto();
        this.update.__touch();
    })();
}

function cleanInsert(target, element) {
    target.innerHTML = "";
    target.appendChild(element);
}
class Csv {
    constructor(table, opts) {
        this.table = table;
        this._head = opts.head || true;
        this._remove = opts.remove || [];
        this.rows = [...this.table.querySelectorAll("tr")].map(el => el.cloneNode(true));
        if (!this._head) {
            this.rows.forEach(row => {
                row.parentElement && (row.parentElement.tagName == "THEAD") && row.parentElement.removeChild(row);
            });
        }
        for (const index of this._remove) {
            this.rows.forEach(row => row.childNodes[index].remove());
        }
    }
    _rowLength() {
        return this.rows.reduce((l, row) => row.childNodes.length > l ? row.childNodes.length : l, 0);
    }
    static parse(cell) {
        let parsedValue = (cell.textContent || "").trim().replace(/\n\r|\n|\r/g, "").replace(/\s{2,}/g, " ");
        parsedValue = parsedValue.replace(/"/g, `""`);
        parsedValue = /[",\n]/.test(parsedValue) ? `"${parsedValue}"` : parsedValue;
        return parsedValue;
    }
    convert() {
        const lines = [];
        const numCols = this._rowLength();
        for (const row of this.rows) {
            let line = "";
            for (let i = 0; i < numCols; i++) {
                if (row.childNodes[i] !== undefined) {
                    line += Csv.parse(row.childNodes[i]);
                }
                line += (i !== (numCols - 1)) ? "," : "";
            }
            lines.push(line);
        }
        return lines.join("\n");
    }
}
class Class {
    static add(el, ...args) {
        for (let c of args) {
            el.classList.add(c.trim());
        }
    }
    static toggle(el, ...args) {
        for (let c of args) {
            el.classList.toggle(c.trim());
        }
    }
    static remove(el, ...args) {
        for (let c of args) {
            el.classList.remove(c.trim());
        }
    }
}
class UcFirst {
    constructor() {
        let targets = [...document.querySelectorAll(`[${UcFirst._trigger}]`)];
        if (UcFirst._el)
            targets = [...targets, ...(Array.isArray(UcFirst._el) ? UcFirst._el : [UcFirst._el])];
        if (!targets.length)
            return;
        for (let i = 0; i < targets.length; i++) {
            const current = targets[i];
            const text = (current.textContent || "").trim();
            current.textContent = text.length ? text[0].toUpperCase() + text.slice(1) : text;
            current.removeAttribute(UcFirst._trigger);
        }
    }
    static option(opts) {
        this._trigger = opts.trigger || "x-ucfirst";
        this._el = opts.el || null;
    }
}
UcFirst._trigger = "x-ucfirst";
UcFirst._el = null;
class Toggle {
    constructor() {
        let triggers = [...document.querySelectorAll(`[${Toggle._trigger}]`)];
        if (Toggle._el)
            triggers = [...triggers, ...(Array.isArray(Toggle._el) ? Toggle._el : [Toggle._el])];
        if (!triggers.length)
            return;
        for (let i = 0; i < triggers.length; i++) {
            const current = triggers[i];
            const map = {
                properties: (current.getAttribute(Toggle._properties) || "").split(",") || [],
                trigger: current,
                targets: [],
            };
            const selector = map.trigger.getAttribute(Toggle._trigger);
            if (!selector)
                continue;
            const targets = selector.split(",");
            for (let j = 0; j < targets.length; j++) {
                const _current = targets[j].trim();
                const elements = document.querySelectorAll(_current);
                if (!elements.length)
                    continue;
                map.targets = [...map.targets, ...elements];
            }
            map.trigger.addEventListener("click", () => {
                for (let j = 0; j < map.targets.length; j++) {
                    const target = map.targets[j];
                    Class.toggle(target, ...map.properties);
                }
            });
            map.trigger.removeAttribute(Toggle._trigger);
            map.trigger.removeAttribute(Toggle._properties);
        }
    }
    static option(opts) {
        this._trigger = opts.trigger || "x-toggle";
        this._properties = opts.properties || "x-properties";
        this._el = opts.el || null;
    }
}
Toggle._trigger = "x-toggle";
Toggle._properties = "x-properties";
Toggle._el = null;
class Password {
    constructor() {
        let targets = [...document.querySelectorAll(`[${Password._trigger}]`)];
        if (Password._el)
            targets = [...targets, ...(Array.isArray(Password._el) ? Password._el : [Password._el])];
        if (!targets.length)
            return;
        for (let i = 0; i < targets.length; i++) {
            const current = targets[i];
            ("type" in current) && (current.type = "password");
            const wrapper = document.createElement("div");
            wrapper.className = "relative";
            wrapper.innerHTML = Password._button;
            current.className = Password._classes;
            current.insertAdjacentElement('afterend', wrapper);
            wrapper.insertAdjacentElement('afterbegin', current);
            const button = wrapper.querySelector('button');
            const paths = wrapper.querySelectorAll('svg path');
            button.addEventListener("click", e => {
                ("type" in current) && (current.type = current.type == "password" ? "text" : "password");
                Class.toggle(paths[0], "hidden");
                Class.toggle(paths[1], "hidden");
            });
            current.removeAttribute(Password._trigger);
        }
    }
    static option(opts) {
        this._trigger = opts.trigger || "x-password";
        this._el = opts.el || null;
    }
}
Password._trigger = "x-password";
Password._el = null;
Password._button = `
        <button type="button"
            class="absolute left-4 top-1/2 -translate-y-1/2 appearance-none rounded-md">
            <svg class="block w-6 h-6 pointer-events-none"
                fill="currentcolor" viewBox="0 0 48 48">
                <path
                    d="M24 31.35q3.5 0 5.925-2.45T32.35 23q0-3.5-2.45-5.925T24 14.65q-3.5 0-5.925 2.45T15.65 23q0 3.5 2.45 5.925T24 31.35Zm0-3.55q-2 0-3.4-1.425T19.2 23q0-2 1.425-3.4T24 18.2q2 0 3.4 1.425T28.8 23q0 2-1.425 3.4T24 27.8ZM24 39q-7.2 0-13.05-3.95-5.85-3.95-9.1-10.4-.2-.3-.3-.75-.1-.45-.1-.9t.1-.9q.1-.45.3-.85 3.25-6.35 9.1-10.3Q16.8 7 24 7q7.2 0 13.05 3.95 5.85 3.95 9.1 10.3.2.4.3.85.1.45.1.85 0 .45-.1.925-.1.475-.3.775-3.25 6.45-9.1 10.4T24 39Z" />
                <path class="hidden"
                    d="m39 33.7-7.4-7.4q.4-.6.575-1.55.175-.95.175-1.75 0-3.5-2.425-5.925T24 14.65q-.85 0-1.65.175-.8.175-1.65.575l-6.4-6.45q1.7-.7 4.525-1.325T24.25 7q6.8 0 12.775 3.775Q43 14.55 46.25 21.25q.15.4.225.85.075.45.075.9t-.075.925q-.075.475-.275.775-1.35 2.8-3.2 5.025-1.85 2.225-4 3.975Zm.1 10-6.45-6.25q-1.75.7-3.975 1.125Q26.45 39 24 39q-7.05 0-12.975-3.775T1.8 24.65q-.2-.35-.275-.775Q1.45 23.45 1.45 23t.1-.95q.1-.5.25-.85 1.05-2.15 2.675-4.25 1.625-2.1 3.675-4.1L3.3 7.95q-.5-.4-.5-1.125T3.3 5.6q.4-.45 1.15-.45.75 0 1.25.45l35.8 35.8q.45.5.375 1.175-.075.675-.375 1.075-.55.55-1.275.55-.725 0-1.125-.5ZM24 31.35q.6 0 1.225-.15.625-.15 1.025-.3L16 20.75q-.1.5-.225 1.1-.125.6-.125 1.15 0 3.55 2.45 5.95 2.45 2.4 5.9 2.4Zm4.1-8.6-3.6-3.6q1.35-.9 2.95.35t.65 3.25Z" />
            </svg>
        </button>
    `;
Password._classes = "appearance-none bg-transparent text-lg rounded-md lg:rounded-xl h-[48px] block w-full pl-12 py-2 px-4";
class Table {
    constructor() {
        let targets = [...document.querySelectorAll(`[${Table._trigger}]`)];
        if (Table._el)
            targets = [...targets, ...(Array.isArray(Table._el) ? Table._el : [Table._el])];
        if (!targets.length)
            return;
        for (let i = 0; i < targets.length; i++) {
            const current = targets[i];
            const wrapper = document.createElement("div");
            const parent = current.parentElement;
            wrapper.innerHTML = Table._template();
            wrapper.className = "w-full overflow-auto";
            const pagination = wrapper.querySelector("[data-pages]");
            const container = wrapper.querySelector("[data-container]");
            const downloadbtn = wrapper.querySelector("[data-download]");
            const table = wrapper.querySelector("table");
            const select = wrapper.querySelector("select");
            const search = wrapper.querySelector("input");
            pagination.removeAttribute("data-pages");
            container.removeAttribute("data-container");
            downloadbtn.removeAttribute("data-download");
            const _remove = (current.getAttribute(Table._remove) || "").split(",").map(e => parseInt(e));
            const _head = current.getAttribute(Table._head) === "false" ? false : true;
            const _name = current.getAttribute(Table._name) || "";
            downloadbtn.addEventListener("click", () => {
                this._download(current, _name, _remove, _head);
            });
            if (current.tHead) {
                const _ = document.createElement("tr");
                for (let td of current.querySelectorAll("thead tr td")) {
                    _.insertAdjacentHTML("beforeend", `
                        <td class="w-max px-4 py-2">${td.innerHTML}</td>
                    `);
                }
                table.tHead.appendChild(_);
            }
            for (let tr of current.querySelectorAll("tbody tr")) {
                const _ = document.createElement("tr");
                for (let td of tr.querySelectorAll("td")) {
                    _.insertAdjacentHTML("beforeend", `
                        <td class="px-4 py-2 max-w-[400px]">${td.innerHTML}</td>
                    `);
                }
                table.tBodies[0].appendChild(_);
            }
            const length = table.tHead.querySelectorAll("td").length,
                body = table.tBodies[0],
                rows = [...body.children];
            let items = [...body.children],
                pages = this._chunck(items),
                index = 0;
            select.addEventListener("change", e => {
                pages = this._chunck(items, parseInt(select.value));
                index = 0;
                if (pagination && body && pages && length && container) {
                    this._populate(body, pages, index, length, container);
                    this._pagination(pagination, pages, body, length, container);
                }
            });
            search.addEventListener("input", e => {
                const filter = (e.target.value.toUpperCase() || "").trim();
                if (filter === "") {
                    items = rows;
                } else {
                    const __ = [];
                    rows.forEach(item => {
                        const phrase = item.innerText.toUpperCase().trim();
                        for (const niddle of filter.split(" ")) {
                            if (phrase.includes(niddle)) {
                                __.push(item);
                            }
                        }
                    });
                    items = __;
                }
                pages = this._chunck(items, parseInt(select.value) || undefined);
                index = 0;
                if (pagination && body && pages && length && container) {
                    this._populate(body, pages, index, length, container);
                    this._pagination(pagination, pages, body, length, container);
                }
            });
            if (rows && select && rows.length > 50)
                select.selectedIndex = 1;
            if (rows && select && rows.length > 100)
                select.selectedIndex = 2;
            pages = this._chunck(items, parseInt(select.value) || undefined);
            if (pagination && body && pages && length && container) {
                this._populate(body, pages, index, length, container);
                this._pagination(pagination, pages, body, length, container);
            }
            cleanInsert(parent, wrapper);
            current.removeAttribute(Table._remove);
            current.removeAttribute(Table._head);
            current.removeAttribute(Table._name);
        }
    };
    static option(opts) {
        this._trigger = opts.trigger || "x-table";
        this._name = opts.name || "x-name";
        this._head = opts.head || "x-head";
        this._remove = opts.remove || "x-remove";
        this._el = opts.el || null;
        this._style = {
            color: opts.style.color || "#FFFFFF",
            background: opts.style.background || "#60A5FA",
            header: opts.style.header || "#60A5FA",
            text: opts.style.text || "#FFFFFF",
        };
    }
    _chunck(items, nbr = 10) {
        return items.reduce((resultArray, item, index) => {
            const chunkIndex = Math.floor(index / nbr);
            if (!resultArray[chunkIndex]) {
                resultArray[chunkIndex] = [];
            }
            resultArray[chunkIndex].push(item);
            return resultArray;
        }, []);
    }
    _populate(body, pages, index, length, wrapper) {
        body.innerHTML = "";
        if (pages.length === 0)
            body.innerHTML = "<tr><td class='py-2 text-center uppercase' colspan='" + length + "'>لم يتم العثور على سجلات</td></tr>";
        else
            pages[index].forEach((row, i) => {
                if (i % 2)
                    row.className = "bg-gray-50";
                else
                    row.className = "";
                body.append(row);
            });
        wrapper.scrollTop = 0;
    }
    _select(wrapper, target) {
        for (let item of wrapper.children) {
            item.removeAttribute("style");
        }
        target.style.backgroundColor = Table._style.background;
        target.style.color = Table._style.color;
    }
    _pagination(container, pages, body, length, wrapper) {
        container.innerHTML = "";
        pages.forEach((_, i) => {
            const btn = document.createElement("button");
            btn.className = Table._btnClasses;
            btn.innerHTML = String(i + 1);
            if (i === 0) {
                this._select(container, btn);
            }
            container.append(btn);
            btn.addEventListener("click", e => {
                const index = [...container.childNodes].indexOf(btn);
                this._select(container, btn);
                this._populate(body, pages, index, length, wrapper);
            });
        });
    }
    _download(table, name, remove, head) {
        const opts = {
            head: head,
            remove: remove
        };
        const exporter = new Csv(table, opts);
        const csvOutput = exporter.convert();
        const csvBlob = new Blob([csvOutput], {
            type: "text/csv"
        });
        const blobUrl = URL.createObjectURL(csvBlob);
        const anchorElement = document.createElement("a");
        anchorElement.href = blobUrl;
        anchorElement.download = name;
        anchorElement.click();
        anchorElement.remove();
        setTimeout(() => {
            URL.revokeObjectURL(blobUrl);
        }, 500);
    }
}
Table._trigger = "x-table";
Table._name = "x-name";
Table._head = "x-head";
Table._remove = "x-remove";
Table._el = null;
Table._style = {
    color: "#FFFFFF",
    background: "#60A5FA",
    header: "#60A5FA",
    text: "#FFFFFF",
};
Table._btnClasses = "w-8 h-8 appearance-none text-md flex items-center justify-center rounded-md lg:rounded-lg font-black outline-none cursor-pointer bg-gray-900 text-gray-950";
Table._template = () => /*html*/ `
        <div class="flex gap-4 justify-between">
            <input type="search" placeholder="بحث..." class="flex-1 w-0 lg:w-56 h-[48px] lg:flex-none appearance-none bg-gray-200 text-gray-950 text-lg rounded-md lg:rounded-xl block py-2 px-4" />
            <div class="w-max flex flex-wrap gap-4 items-stretch">
                <div class="w-20 relative">
                    <select class="w-full h-[48px] appearance-none bg-gray-200  text-gray-950 text-lg rounded-md lg:rounded-xl block py-2 px-4">
                            <option value="10">10</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    <svg class="block w-4 h-4 text-gray-950 pointer-events-none absolute left-3 top-1/2 -translate-y-1/2" fill="currentcolor" viewBox="0 96 960 960">
                        <path d="M480 715q-10 0-18-3t-14-11L251 505q-13-13-13-32.5t13-33.5q14-13 32.5-13t31.5 13l165 165 164-165q14-13 33-13t32 13q14 14 14 33t-14 32L512 701q-6 7-14.5 10.5T480 715Z"/>
                    </svg>
                </div>
                <button data-download class="w-[48px] h-[48px] flex items-center justify-center rounded-md lg:rounded-xl text-gray-50 bg-green-600 outline-none hover:bg-green-400 focus:bg-green-400">
                    <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 96 960 960">
                    <path d="M479.256 703q-8.847 0-16.951-3.955Q454.2 695.091 448 689L288 530q-12-13-12-32.5t14-33q13-12.5 31.5-12.5t32.5 13l80 82V236q0-20.075 13.56-33.537Q461.119 189 479.86 189q20.14 0 32.64 13.463Q525 215.925 525 236v311l82-82q13-13 32-13t32 13q13 13 13 32.5T671 530L512 689q-6.195 6-15.261 10-9.066 4-17.483 4ZM205 940q-35.775 0-63.388-27.034Q114 885.931 114 847.5V706q0-18.8 13.56-32.4 13.559-13.6 32.3-13.6 20.14 0 32.64 13.6t12.5 32.297V848h549V705.897q0-18.697 12.86-32.297 12.859-13.6 32.5-13.6Q819 660 832 673.6t13 32.297V848q0 38.225-28.138 65.112Q788.725 940 754 940H205Z"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="w-full rounded-md lg:rounded-xl my-4 overflow-hidden">
            <div data-container class="overflow-auto max-h-[800px] hover-scrollbar rounded-md lg:rounded-xl border border-gray-300">
                <table class="w-max min-w-full text-md text-gray-950">
                    <thead class="uppercase text-xs font-black sticky top-0 border-b border-gray-300" style="color: ${Table._style.text};background: ${Table._style.header};"></thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <div data-pages class="w-full gap-2 flex justify-center flex-wrap lg:justify-end lg:ml-auto">
        </div>
    `;
class Select {
    constructor() {
        let targets = [...document.querySelectorAll(`[${Select._trigger}]`)];
        if (Select._el)
            targets = [...targets, ...(Array.isArray(Select._el) ? Select._el : [Select._el])];
        if (!targets.length)
            return;
        for (let i = 0; i < targets.length; i++) {
            const current = targets[i];
            if (current.multiple) {
                current.data = [];
                current.xname = current.name;
                current.removeAttribute("name");
            }
            Class.add(current, "hidden");
            const wrapper = document.createElement("div");
            Class.add(wrapper, "relative");
            wrapper.innerHTML = Select._template(current.getAttribute("placeholder"));
            const search = wrapper.querySelector('input[type="search"]');
            const display = wrapper.querySelector("[contenteditable]");
            const container = wrapper.querySelector("[x-wrap]");
            const button = wrapper.querySelector("button");
            const list = wrapper.querySelector("ul");
            container.removeAttribute("x-wrap");
            current.addEventListener("click", () => {
                display.click();
            });
            search.addEventListener("input", e => {
                const filter = e.target.value.toUpperCase().trim();
                for (let item of wrapper.querySelectorAll("li:not(.header)")) {
                    const phrase = item.innerText.toUpperCase().trim();
                    for (const niddle of filter.split(" ")) {
                        if (phrase.includes(niddle))
                            Class.remove(item, "hidden");
                        else
                            Class.add(item, "hidden");
                    }
                }
            });
            for (let el of[display, button]) {
                el.addEventListener("click", (e) => {
                    e.preventDefault();
                    Select._toggle({
                        container: container,
                        current: current,
                        search: search,
                        list: list,
                    });
                });
            }
            const config = {
                childList: true,
                subtree: true,
                attributes: true
            };
            const observer = new MutationObserver(() => {
                Select._execute({
                    container: container,
                    search: search,
                    input: display,
                    current: current,
                    list: list,
                });
            });
            Select._execute({
                container: container,
                search: search,
                input: display,
                current: current,
                list: list,
            });
            observer.observe(current, config);
            current.insertAdjacentElement("afterend", wrapper);
            current.removeAttribute(Select._trigger);
        }
    }
    static option(opts) {
        this._trigger = opts.trigger || "x-select";
        this._el = opts.el || null;
        this._style = {
            color: opts.style.color || "#FFFFFF",
            background: opts.style.background || "#60A5FA",
        };
    }
    static _toggle(el) {
        for (let item of el.list.children) {
            Class.remove(item, "hidden");
        }
        Class.toggle(el.container, "hidden", "flex");
        Class.remove(el.container, "lg:top-full", "lg:bottom-full");
        var _ = ((window.innerHeight - el.container.getBoundingClientRect().top) < el.container.clientHeight) ? "lg:bottom-full" : "lg:top-full";
        Class.add(el.container, _);
        el.container.scrollTop = 0;
        el.search.value = "";
        el.current.dispatchEvent(new CustomEvent('toggle', {
            bubbles: true,
        }));
    }
    static _select(el, i = 0) {
        if (el.current.multiple) {
            if (el.target.hasAttribute("style")) {
                const i = el.current.data.indexOf(el.option);
                el.current.data.splice(i, 1);
                el.target.removeAttribute("style");
            } else {
                el.target.style.backgroundColor = Select._style.background;
                el.target.style.color = Select._style.color;
                !el.current.data.includes(el.option) && el.current.data.push(el.option);
            }
            el.input.innerHTML = el.current.data.map(e => `<span class="rounded-sm text-xs p-1" style="color: ${Select._style.color};background: ${Select._style.background}">${e.innerText.trim()}</span>`).join("").trim();
            [...el.container.querySelectorAll("[x-select-input]")].forEach(e => e.remove());
            el.current.data.forEach(e => {
                el.container.insertAdjacentHTML('beforeend', `<input x-select-input type="hidden" value="${e.value}" name="${el.current.xname}"/>`);
            });
        } else {
            el.current.selectedIndex = i;
            el.input.innerText = el.target.innerText.trim();
            for (let item of el.list.children) {
                item.removeAttribute("style");
            }
            el.target.style.backgroundColor = Select._style.background;
            el.target.style.color = Select._style.color;
        }
    }
    static _execute(el) {
        el.list.innerHTML = "";
        const options = [...el.current.querySelectorAll(":scope > option")].map(op => {
            op.padd = "";
            return op;
        });
        const groups = el.current.querySelectorAll("optgroup");
        if (groups.length) {
            for (let group of groups) {
                options.push({
                    text: group.label,
                    head: true
                }, ...[...group.querySelectorAll("option")].map(op => {
                    op.padd = "px-4 ";
                    return op;
                }));
            }
        }
        if (options.length < 10) Class.add(el.search, 'hidden');
        else Class.remove(el.search, 'hidden');
        for (let i = 0; i < options.length; i++) {
            const option = options[i];
            const index = [...el.current.options].indexOf(option);
            if (option.head) {
                const item = document.createElement("li");
                item.className = "text-gray-950 text-md px-2 py-1 font-black header";
                item.innerHTML = option.text.trim();
                el.list.append(item);
            } else {
                if (!option.innerText.trim().length)
                    continue;
                const item = document.createElement("li");
                item.className = option.padd + "text-gray-950 text-md p-2";
                item.innerHTML = option.innerText.trim();
                if (option.hasAttribute("selected") && !option.hasAttribute("disabled")) {
                    Select._select({
                        list: el.list,
                        container: el.container,
                        current: el.current,
                        input: el.input,
                        target: item,
                        option: option
                    }, index);
                }
                if (option.hasAttribute("disabled")) {
                    item.className += " bg-gray-400";
                } else {
                    item.className += " hover:bg-gray-950 hover:text-gray-950 hover:bg-opacity-10 cursor-pointer";
                    item.addEventListener("click", e => {
                        Select._select({
                            list: el.list,
                            container: el.container,
                            current: el.current,
                            input: el.input,
                            target: item,
                            option: option,
                        }, index);
                        if (!el.current.multiple) {
                            Select._toggle({
                                container: el.container,
                                current: el.current,
                                search: el.search,
                                list: el.list
                            });
                        }
                        el.current.dispatchEvent(new CustomEvent('select', {
                            bubbles: true,
                            detail: {
                                item: item,
                                index: index,
                            }
                        }));
                    });
                }
                el.list.append(item);
            }
        }
        el.current.dispatchEvent(new CustomEvent('load', {
            bubbles: true,
            detail: {
                display: el.input,
                search: el.search,
            }
        }));
    }
}
Select._trigger = "x-select";
Select._el = null;
Select._style = {
    color: "#FFFFFF",
    background: "#60A5FA",
};
Select._template = (placeholder) => /*html*/ `
        <div tabindex="0" class="w-full flex items-center appearance-none h-[48px] text-lg rounded-md lg:rounded-xl pl-12 py-2 px-4 bg-transparent cursor-pointer">
            <div class="w-full overflow-x-auto no-scrollbar">
                <div contenteditable="false" placeholder="${placeholder || "&nbsp;"}" class="w-max min-w-full flex gap-2 items-center"></div>
            </div>
        </div>
        <svg class="block w-6 h-6 pointer-events-none absolute left-4 top-1/2 -translate-y-1/2" fill="currentcolor" viewBox="0 0 48 48">
            <path d="M24 31.8 10.9 18.7 14.2 15.45 24 25.35 33.85 15.5 37.1 18.75Z" />
        </svg>
        <div x-wrap class="fixed items-center justify-center p-4 inset-0 bg-gray-900 bg-opacity-80 z-20 lg:z-10 lg:absolute lg:top-full lg:inset-auto lg:p-0 lg:w-full lg:rounded-lg hidden">
            <button class="w-10 h-10 absolute top-4 left-4 text-gray-950 rounded-full lg:hidden flex items-center justify-center outline-none hover:bg-gray-50 hover:bg-opacity-10 focus:bg-gray-50 focus:bg-opacity-10">
                <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 96 960 960">
                    <path d="M480 640 282 838q-14 14-32.5 14T218 838q-14-13-14-31.5t14-31.5l198-199-198-198q-13-13-13-32t13-32q12-13 31-13t33 13l198 199 199-200q13-13 31.5-13t32.5 13q13 14 13 32.5T743 377L544 575l198 199q14 14 14 32.5T742 838q-13 14-32 14t-31-14L480 640Z"/>
                </svg>
            </button>
            <div class="w-full bg-gray-50 rounded-lg shadow-md overflow-hidden">
                <div class="w-full overflow-auto max-h-100 lg:max-h-60">
                    <input id="search" type="search" placeholder="Search" class="appearance-none sticky top-0 bg-gray-50 border-b border-gray-300 text-gray-950 text-md block w-full p-2 outline-none" />
                    <ul class="w-full">
                    </ul>
                </div>
            </div>
        </div>
    `;
class DatePicker {
    constructor() {
        let targets = [...document.querySelectorAll(`[${DatePicker._trigger}]`)];
        if (DatePicker._el)
            targets = [...targets, ...(Array.isArray(DatePicker._el) ? DatePicker._el : [DatePicker._el])];
        if (!targets.length)
            return;
        for (let i = 0; i < targets.length; i++) {
            const current = targets[i];
            current.date = new Date();
            Class.add(current, "hidden");
            current.setAttribute("readonly", "true");
            current._remove = (current.getAttribute(DatePicker._remove) || "").split(",").map(e => formatDate(new Date(e.trim())));
            const wrapper = document.createElement("div");
            Class.add(wrapper, "relative");
            wrapper.innerHTML = DatePicker._template(current.getAttribute("placeholder"));
            const container = wrapper.querySelector("div");
            const input = wrapper.querySelector("input");
            const list = wrapper.querySelectorAll("ul")[1];
            const head = wrapper.querySelector("h1");
            const buttons = wrapper.querySelectorAll("button");
            current.addEventListener("click", () => {
                input.click();
            });
            if (current.value) {
                input.value = (new Date(current.value)).toISOString().split('T')[0];
                current.value = (new Date(current.value)).toISOString().split('T')[0];
                current.date = new Date(current.value);
            }
            for (let el of[input, buttons[0]]) {
                el.addEventListener("click", (e) => {
                    e.preventDefault();
                    DatePicker._toggle({
                        container: container,
                        input: input,
                        current: current,
                        list: list,
                        head: head,
                    });
                });
            }
            const config = {
                childList: true,
                subtree: true,
                attributes: true,
                attributeFilter: ["value"]
            };
            const observer = new MutationObserver(mutationsList => {
                for (let mutation of mutationsList) {
                    if (mutation.type === "attributes" && mutation.attributeName === "value") {
                        const date = current.value.split("-");
                        current.date.setFullYear(Number(date[0]));
                        current.date.setMonth(Number(date[1]) - 1);
                        current.date.setDate(Number(date[2]));
                        var day = current.date.getDate() < 10 ? "0" + current.date.getDate() : current.date.getDate(),
                            mon = current.date.getMonth() + 1 < 10 ? "0" + (current.date.getMonth() + 1) : current.date.getMonth() + 1,
                            _date = current.date.getFullYear() + "-" + mon + "-" + day;
                        input.value = _date;
                    }
                }

                DatePicker._execute({
                    container: container,
                    input: input,
                    current: current,
                    list: list,
                    head: head,
                });
            });
            DatePicker._execute({
                container: container,
                input: input,
                current: current,
                list: list,
                head: head,
            });
            buttons[1].addEventListener("click", e => {
                e.preventDefault();
                current.date.setMonth(current.date.getMonth() - 1);
                DatePicker._execute({
                    container: container,
                    input: input,
                    current: current,
                    list: list,
                    head: head,
                });
            });
            buttons[2].addEventListener("click", e => {
                e.preventDefault();
                current.date.setMonth(current.date.getMonth() + 1);
                DatePicker._execute({
                    container: container,
                    input: input,
                    current: current,
                    list: list,
                    head: head,
                });
            });
            observer.observe(current, config);
            current.insertAdjacentElement("afterend", wrapper);
            current.removeAttribute(DatePicker._trigger);
            current.removeAttribute(DatePicker._remove);
        }
    }
    static option(opts) {
        this._trigger = opts.trigger || "x-date";
        this._remove = opts.remove || "x-remove";
        this._el = opts.el || null;
        this._style = {
            color: opts.style.color || "#FFFFFF",
            background: opts.style.background || "#60A5FA",
            current: opts.style.current || "#93C5FD",
        };
    }
    static _toggle(el) {
        Class.toggle(el.container, "hidden", "flex");
        Class.remove(el.container, "lg:top-full", "lg:bottom-full");
        var _ = ((window.innerHeight - el.container.getBoundingClientRect().top) < el.container.clientHeight) ? "lg:bottom-full" : "lg:top-full";
        Class.add(el.container, _);
        DatePicker._execute(el, el.current.date);
        el.current.dispatchEvent(new CustomEvent('toggle', {
            bubbles: true,
        }));
    }
    static _execute(el, date) {
        el.list.innerHTML = "";
        var d = date === undefined ? null : date.getDate();
        var m = date === undefined ? null : date.getMonth();
        var y = date === undefined ? null : date.getFullYear();
        const _d = new Date(el.current.date);
        _d.setDate(1);
        var lastDay = new Date(_d.getFullYear(), _d.getMonth() + 1, 0).getDate();
        var firstDayIndex = _d.getDay();
        var lastDayIndex = new Date(_d.getFullYear(), _d.getMonth() + 1, 0).getDay();
        var nextDays = 7 - lastDayIndex - 1;
        el.head.innerHTML = DatePicker._months[_d.getMonth()] + ", " + _d.getFullYear();
        for (var i = firstDayIndex; i > 0; i--) {
            const item = document.createElement("li");
            item.className = "w-full";
            el.list.append(item);
        }
        for (var i = 1; i <= lastDay; i++) {
            var day = i < 10 ? "0" + i : i,
                mon = el.current.date.getMonth() + 1 < 10 ? "0" + (el.current.date.getMonth() + 1) : el.current.date.getMonth() + 1,
                _date = el.current.date.getFullYear() + "-" + mon + "-" + day,
                item = document.createElement("li");
            item.className = DatePicker._class;
            item.dataset.date = _date;
            item.dataset.day = DatePicker._days[(new Date(_date)).getDay()].toLowerCase();
            item.innerText = day;
            if (el.current.value === _date) {
                item.style.backgroundColor = DatePicker._style.background;
                item.style.color = DatePicker._style.color;
            } else if (i === new Date().getDate() && el.current.date.getMonth() === new Date().getMonth() && el.current.date.getFullYear() === new Date().getFullYear()) {
                item.style.backgroundColor = DatePicker._style.current;
            }
            if (el.current._remove.includes(_date)) {
                Class.add(item, 'pointer-events-none', 'bg-gray-300', 'text-gray-500');
                Class.remove(item, 'text-gray-950');
                item.style.backgroundColor = "";
                item.style.color = "";
            }
            item.addEventListener("click", e => {
                el.input.value = e.target.dataset.date;
                el.current.value = e.target.dataset.date;
                const date = el.current.value.split("-");
                el.current.date.setFullYear(Number(date[0]));
                el.current.date.setMonth(Number(date[1]) - 1);
                el.current.date.setDate(Number(date[2]));
                DatePicker._toggle(el);
                el.current.dispatchEvent(new CustomEvent('select', {
                    bubbles: true,
                    detail: {
                        item: item,
                        date: e.target.dataset.date,
                    }
                }));
            });
            el.list.append(item);
        }
        for (var i = 1; i <= nextDays; i++) {
            const item = document.createElement("li");
            item.className = "w-full";
            el.list.append(item);
        }
    }
}
DatePicker._trigger = "x-date";
DatePicker._remove = "x-remove";
DatePicker._el = null;
DatePicker._style = {
    color: "#FFFFFF",
    background: "#60A5FA",
    current: "#93C5FD",
};
DatePicker._template = (placeholder) => /*html*/ `
        <input readonly type="text" placeholder="${placeholder || ""}" class="appearance-none h-[48px] bg-transparent text-md rounded-md lg:rounded-xl block w-full pl-12 py-2 px-4 cursor-pointer"
        />
        <span class="flex w-6 h-6 items-center justify-center absolute left-4 top-1/2 -translate-y-1/2">
            <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                <path d="M24 28.25q-.9 0-1.575-.65-.675-.65-.675-1.6 0-.9.675-1.575.675-.675 1.625-.675.9 0 1.55.65t.65 1.6q0 .9-.65 1.575-.65.675-1.6.675Zm-8 0q-.9 0-1.575-.65-.675-.65-.675-1.6 0-.9.65-1.575.65-.675 1.6-.675.9 0 1.575.65.675.65.675 1.6 0 .9-.65 1.575-.65.675-1.6.675Zm15.95 0q-.85 0-1.525-.65-.675-.65-.675-1.6 0-.9.675-1.575.675-.675 1.575-.675.9 0 1.575.65.675.65.675 1.6 0 .9-.675 1.575-.675.675-1.625.675Zm-7.95 8q-.9 0-1.575-.675Q21.75 34.9 21.75 34q0-.9.675-1.575.675-.675 1.625-.675.9 0 1.55.675t.65 1.625q0 .85-.65 1.525-.65.675-1.6.675Zm-8 0q-.9 0-1.575-.675Q13.75 34.9 13.75 34q0-.9.65-1.575.65-.675 1.6-.675.9 0 1.575.675.675.675.675 1.625 0 .85-.65 1.525-.65.675-1.6.675Zm15.95 0q-.85 0-1.525-.675Q29.75 34.9 29.75 34q0-.9.675-1.575.675-.675 1.575-.675.9 0 1.575.675.675.675.675 1.625 0 .85-.675 1.525-.675.675-1.625.675ZM9.5 45.1q-1.85 0-3.2-1.375T4.95 40.55V10.5q0-1.9 1.35-3.25T9.5 5.9h2.95V4.8q0-.7.625-1.325t1.375-.625q.85 0 1.4.625.55.625.55 1.325v1.1h15.2V4.8q0-.7.575-1.325t1.375-.625q.85 0 1.425.625.575.625.575 1.325v1.1h2.95q1.9 0 3.25 1.35t1.35 3.25v30.05q0 1.8-1.35 3.175Q40.4 45.1 38.5 45.1Zm0-4.55h29V19.6h-29v20.95Z"/>
            </svg>
        </span>
        <div class="fixed items-center justify-center p-4 inset-0 bg-gray-900 bg-opacity-80 z-20 lg:z-10 lg:absolute lg:top-full lg:inset-auto lg:p-0 lg:w-full lg:rounded-lg hidden">
            <button class="w-10 h-10 absolute top-4 left-4 text-gray-950 rounded-full lg:hidden flex items-center justify-center outline-none hover:bg-gray-50 hover:bg-opacity-10 focus:bg-gray-50 focus:bg-opacity-10">
                <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 96 960 960">
                    <path d="M480 640 282 838q-14 14-32.5 14T218 838q-14-13-14-31.5t14-31.5l198-199-198-198q-13-13-13-32t13-32q12-13 31-13t33 13l198 199 199-200q13-13 31.5-13t32.5 13q13 14 13 32.5T743 377L544 575l198 199q14 14 14 32.5T742 838q-13 14-32 14t-31-14L480 640Z"/>
                </svg>
            </button>
            <div class="w-full bg-gray-50 rounded-lg shadow-md overflow-hidden">
                <div class="w-full overflow-auto flex flex-col">
                    <div class="w-full grid grid-rows-1 grid-cols-7 items-center bg-primary p-2">
                        <button class="w-full aspect-square flex items-center justify-center text-gray-50 rounded-md outline-none hover:bg-gray-950 hover:text-gray-50 hover:bg-opacity-10 focus:bg-gray-950 focus:text-gray-50 focus:bg-opacity-10 cursor-pointer">
                            <svg class="block w-10 h-10 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                                <path d="M344-251q-14-15-14-33.5t14-31.5l164-165-165-166q-14-12-13.5-32t14.5-33q13-14 31.5-13.5T407-712l199 199q6 6 10 14.5t4 17.5q0 10-4 18t-10 14L408-251q-13 13-32 12.5T344-251Z"/>
                            </svg>
                        </button>
                        <h1 class="flex-1 text-xl font-black text-gray-50 text-center col-span-5 px-2">
                            Home
                        </h1>
                        <button class="w-full aspect-square flex items-center justify-center text-gray-50 rounded-md outline-none hover:bg-gray-950 hover:text-gray-50 hover:bg-opacity-10 focus:bg-gray-950 focus:text-gray-50 focus:bg-opacity-10 cursor-pointer">
                            <svg class="block w-10 h-10 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                                <path d="M528-251 331-449q-7-6-10.5-14t-3.5-18q0-9 3.5-17.5T331-513l198-199q13-12 32-12t33 12q13 13 12.5 33T593-646L428-481l166 166q13 13 13 32t-13 32q-14 13-33.5 13T528-251Z"/>
                            </svg>
                        </button>
                    </div>
                    <ul class="w-full grid grid-rows-1 grid-cols-7 px-2 mt-2 gap-1">
                        <li class="w-full flex items-center justify-center rounded-md text-gray-950 text-[.8rem]">الأحد</li>
                        <li class="w-full flex items-center justify-center rounded-md text-gray-950 text-[.8rem]">الاثنين</li>
                        <li class="w-full flex items-center justify-center rounded-md text-gray-950 text-[.8rem]">الثلاثاء</li>
                        <li class="w-full flex items-center justify-center rounded-md text-gray-950 text-[.8rem]">الأربعاء</li>
                        <li class="w-full flex items-center justify-center rounded-md text-gray-950 text-[.8rem]">الخميس</li>
                        <li class="w-full flex items-center justify-center rounded-md text-gray-950 text-[.8rem]">الجمعة</li>
                        <li class="w-full flex items-center justify-center rounded-md text-gray-950 text-[.8rem]">السبت</li>
                    </ul>
                    <ul class="w-full grid grid-rows-1 grid-cols-7 px-2 pb-2 gap-1"></ul>
                </div>
            </div>
        </div>
    `;
DatePicker._class = "w-full h-8 flex items-center justify-center font-semibold rounded-md text-gray-950 text-sm hover:bg-gray-950 hover:text-gray-950 hover:bg-opacity-10 cursor-pointer";
DatePicker._months = ["يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"];
DatePicker._days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

class Toaster {
    constructor(opts = {}) {
        const positionX = opts.positionX || "right";
        const positionY = opts.positionY || "top";
        const classes = [];
        if (positionX === "right") classes.push("right-0")
        if (positionX === "left") classes.push("left-0")
        if (positionX === "center") classes.push("left-1/2", "-translate-x-1/2");

        if (positionY === "top") classes.push("top-0")
        if (positionY === "bottom") classes.push("bottom-0")
        if (positionY === "center") classes.push("top-1/2", "-translate-y-1/2");

        this.timer = opts.timer || 5000;
        this.width = opts.width || 400;
        this.container = document.createElement("section");
        this.container.className = "fixed z-20 max-w-full flex flex-col-reverse gap-4 p-4 overflow-hidden " + classes.join(" ");
        this.container.style.width = this.width + "px";
        document.body.insertAdjacentElement("afterbegin", this.container)
    }

    toast(message, color) {
        const div = document.createElement("div");
        div.className = `relative w-full opacity-0 duration-500 opacity-0 rounded-lg lg:rounde-2xl text-${color}-600 border border-${color}-600 bg-${color}-200 p-2 pr-8 text-lg shadow-md`;
        div.innerHTML = message + `
            <button class="block absolute top-2 left-2 rounded-md">
                <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                    <path
                        d="M12.45 37.65 10.35 35.55 21.9 24 10.35 12.45 12.45 10.35 24 21.9 35.55 10.35 37.65 12.45 26.1 24 37.65 35.55 35.55 37.65 24 26.1Z"
                    />
                </svg>
            </button>
        `;
        div.querySelector("button").addEventListener("click", () => div.remove());
        this.container.appendChild(div);
        setTimeout(() => {
            Class.remove(div, "opacity-0");
            setTimeout(() => {
                div.remove();
            }, this.timer);
        }, 10);
        return this;
    }

    success(message) {
        return this.toast(message, "green");
    }

    warning(message) {
        return this.toast(message, "yellow");
    }

    info(message) {
        return this.toast(message, "blue");
    }

    error(message) {
        return this.toast(message, "red");
    }
}

function getDateRange(startDateStr, endDateStr) {
    var startDate = new Date(startDateStr);
    var endDate = new Date(endDateStr);
    var dateRange = [];
    while (startDate <= endDate) {
        dateRange.push(formatDate(startDate));
        startDate.setDate(startDate.getDate() + 1);
    }
    return dateRange;
}

function formatDate(date) {
    var year = date.getFullYear();
    var month = ('0' + (date.getMonth() + 1)).slice(-2);
    var day = ('0' + date.getDate()).slice(-2);
    return year + '-' + month + '-' + day;
}

function getSpecialDates(range, days) {
    let special = 0;
    let normal = 0;

    for (let i = 0; i < range.length; i++) {
        const currentDate = new Date(range[i]);
        const currentDayNumber = currentDate.getDay();

        if (days.includes(currentDayNumber)) {
            special++;
        } else {
            normal++;
        }
    }

    return {
        special,
        normal
    };
}

function replaceString(array) {
    return array.map(function(string) {
        for (var key in dict) {
            var regex = new RegExp(key, 'g');
            string = string.replace(regex, dict[key]);
        }
        return string;
    });
}

const dict = {
    'email': "البريد الإلكتروني",
    'phone': "الهاتف",
    'identity': "الهوية",
    'first name': "الاسم",
    'last name': "النسب",
    'address': "العنوان",
    'state': "الولاية",
    'city': "المدينة",
    'zipcode': "الرمز البريدي",
    'birth date': "تاريخ الميلاد",
    'gender': "الجنس",
    'title': "الاسم",
    'price': "السعر",
    'area': "المساحة",
    'rooms': "الغرف",
    'kitchen': "المطبخ",
    'garage': "الكراج",
    'garden': "الحديقة",
    'map': "خرائط جوجل",
    'description': "الوصف",
    'property': "العقار",
    'status': "الحالة",
    'nationality': "الجنسية",
    'start date': "موعد الدخول",
    'end date': "موعد الخروج",
    'social number': "الرقم المدني",
    'old password': "الرمز السري القديم",
    'new password': "الرمز السري الجديد",
    'confirm password': "تأكيد الرمز السري",
    'message': "الرسالة",
    'password': "الرمز السري",
    'name': "الاسم الكامل",
    'today': "اليوم",
}

function validateForm(form, fields) {
    var success = true,
        message = "";
    for (let i = 0; i < fields.length; i++) {
        const fieldName = fields[i];
        const fieldValue = form[fieldName].value;
        if (fieldValue.trim() === '') {
            message = 'جميع الحقول مطلوبة';
            success = false;
            break;
        }
    }

    if (success) {
        const period = getDateRange(document.querySelector("#startDate").value, document.querySelector("#endDate").value);
        if (period.length < 3) {
            message = "مدة الحجز يجب أن تكون لا تقل عن 3 أيام";
            success = false;
        }
    }

    if (!success) {
        (new Toaster({
            positionX: "left",
            positionY: "bottom",
            width: 500
        }))['error'](message);
    }

    return success;
}