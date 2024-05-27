import { define } from "hybrids";
import { createRoot } from "react-dom/client";
import { Toast } from "./Toast";

interface BasicInterface {
	data: string;
	type: "info" | "error" | "warn" | "success";
	msg: string;
	delay: string;
}

define<BasicInterface>({
	tag: "message-toast",
	type: "info",
	msg: "",
	delay: "1000",
	data: {
		value: "message_toast",
		connect(host) {
			const { msg, delay, type } = host;
			const Delay = Number.parseInt(delay);

			createRoot(host).render(<Toast msg={msg} delay={Delay} type={type} />);

			return () => {
				createRoot(host).unmount();
			};
		},
	},
});
